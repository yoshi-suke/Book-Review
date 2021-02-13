<?php

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

        return view('books.index', [
          'loginUser' => $loginUser,
          'items' => $items,
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
        $baseUrl = 'https://www.googleapis.com/books/v1/volumes?q=intitle:';
       if (!empty($request->name)) {
        $name = $request->name;
        $requestUrl = $baseUrl . $name;
        $json = file_get_contents($requestUrl);
        $data = json_decode($json);
        $books = $data->items;

        foreach ($books as $book) {
            $bookTitle[] = $book->volumeInfo->title;
            // 著者がいないパターン
            if (isset($book->volumeInfo->authors)) {
              //著者が複数いる場合は各要素を結合する
              $bookAuthors[] =  implode(',', $book->volumeInfo->authors);
            } else {
              $bookAuthors[] =  null;
            }

            // 13桁のISBNがあればそれを設定、なければ10桁を設定、それもなければ'null'を設定
            if (isset($book->volumeInfo->industryIdentifiers)) {
              for ($i = 0; $i < count($book->volumeInfo->industryIdentifiers); $i++) {
                if ($book->volumeInfo->industryIdentifiers[$i]->type === "ISBN_13") {
                    $bookIsbn[] = $book->volumeInfo->industryIdentifiers[$i]->identifier;
                } elseif($book->volumeInfo->industryIdentifiers[$i]->type === "ISBN_10") {
                    $bookIsbn[] = $book->volumeInfo->industryIdentifiers[$i]->identifier;
                } else {
                    $bookIsbn[] = null;
                }
              }
            } else {
              $bookIsbn[] = null;
            }
        }

        $resultNumber = count($bookTitle);
        $response = [];
        for ( $i = 0; $i < $resultNumber; $i++) {
          $responses[$i]['bookTitle'] = $bookTitle[$i];
          $responses[$i]['bookAuthors'] = $bookAuthors[$i];
          $responses[$i]['bookIsbn'] = $bookIsbn[$i];
        }
        $jsonResponse = json_encode($responses);
      }
      return $jsonResponse;
    }

    public function store (Request $request) {
      $book = new Book;
      $form = $request->all();
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
      unset($form['_token']);
      $book->fill($form)->save();
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
      return view('books.users', ['users' => $users]);
    }

    public function showOtherUsers(Book $book) {
      $bookNumber = Book::where('isbn', $book->isbn)->count();
      $users = [];
      for($i = 0; $i < $bookNumber; $i++) {
        $users[] = Book::where('isbn', $book->isbn)->skip($i)->first()->user;
      }
      return view('books.users', ['users' => $users]);

    }

    public function showOtherUserBooks(User $user) {
      $items = User::find($user->id)->books;
      $users = DB::table('users')->get();
      return view('books.otherUser', [
        'items' => $items,
        'users' => $users,
        'user' => $user,
      ]);
    }
}
