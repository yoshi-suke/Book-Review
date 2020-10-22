<?php

//ToDo
//入力値のバリデーション
//GoogleBooksから画像も取得
//タイトルの一部から検索



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\User;

class BooksController extends Controller
{
    public function index (Request $request) {
      //ログインしていたらインデックス表示
      if (Auth::check()) {
        $loginUser = $request->user();
        $items = User::find($loginUser->id)->books()->get();
        // var_dump($items);
        // die;
        // $users = DB::table('users')->get();
        return view('books.index', [
          'loginUser' => $loginUser,
          'items' => $items,
          // 'users' => $users,
        ]);
      } else {
        //ログインしていなかったらLogin画面表示
        return view('auth.login');
      }
    }

    public function create() {
      return view('books.create');
    }

    public function getBookInfo(Request $request) {
      $baseUrl = 'https://www.googleapis.com/books/v1/volumes?q=isbn:';
      if (!empty($request->isbn)) {
        $isbn = $request->isbn;
        $requestUrl = $baseUrl . $isbn;
        $json = file_get_contents($requestUrl);
        $data = json_decode($json);
        $book = $data->items[0];

        $bookTitle = $book->volumeInfo->title;
        $bookAuthors = $book->volumeInfo->authors;

        $response = [];
        $response['bookTitle'] = $bookTitle;
        $response['bookAuthors'] = implode(', ', $bookAuthors);
        $jsonResponse = json_encode($response);
      }
      //単にリターンでOK
      return $jsonResponse;
    }

    public function store (Request $request) {
      $book = new Book;
      $form = $request->all();
      // var_dump($form);
      // die;
      unset($form['_token']);
      $book->user_id = $request->user()->id;
      $book->fill($form)->save();
      return redirect('/books');
    }

    public function edit (Book $book) {
      return view('books.edit', ['book' => $book]);
    }

    public function update (Request $request, Book $book) {
      $form = $request->all();
      // var_dump($form);
      // die;
      unset($form['_token']);
      $book->fill($form)->save();
      // var_dump($request->user()->id);
      // var_dump($book->user_id);
      // die;
      return redirect('/books');
    }

    public function destroy (Book $book) {
      $book->delete();
      return redirect('/books');
    }

    public function users(Request $request) {
      $users = DB::table('users')
        ->where('id', '<>', $request->user()->id)
        ->get();
        // var_dump($users);

      return view('books.users', ['users' => $users]);
    }

    public function showOtherUsers(Book $book) {
      //ここでエラーがでる
      //$book->idのgetなら表示できる
      //$book->idと同じisbnを持つ本を探してそこからuserを探す？？
      //コレクションからはリレーションのメソッドは使えない
      //DB::とBook::の使い分けがよくわからん！！
      //DB::->stdClass
      //Book::->object(Illuminate\Database\Eloquent\Collection)
      // $users = Book::all();
      // $users = Book::where('isbn', "9784297102111")->first();
      $bookNumber = Book::where('isbn', $book->isbn)->count();
      $users = [];
      for($i = 0; $i < $bookNumber; $i++) {
        $users[] = Book::where('isbn', $book->isbn)->skip($i)->first()->user;
      }

      // $users = User::all()->user;
      // $books = DB::table('books')->where('isbn', $book->isbn)->first();
      // $books = Book::where('isbn', $book->isbn)->all()->user()->get();
      // $users = Book::where('isbn', $book->isbn)->first()->user()->get();
      // $user = $books->user()->get();
      // foreach($books as $book) {
        // $user = $book->user();
      // }
      // $users = $book->user()->get();
        // ->user()->get();
      // $books = DB::table('books')->where('isbn', $book->isbn)->get();

      // 9784297102111

      // $users = Book::find($book->id)->user()->get();
      // var_dump($bookNumber);
      // dd($users);
      // var_dump($users);
      return view('books.users', ['users' => $users]);

    }

    public function showOtherUserBooks(User $user) {
      // $items = User::find($user->id)->books()->get();
      $items = User::find($user->id)->books;
      $users = DB::table('users')->get();
      return view('books.otherUser', [
        'items' => $items,
        'users' => $users,
        'user' => $user,
      ]);
    }
}
