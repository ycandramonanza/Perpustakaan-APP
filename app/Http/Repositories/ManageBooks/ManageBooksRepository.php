<?php

namespace App\Http\Repositories\ManageBooks;

use App\Http\Controllers\ManageBooksController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Books;


class ManageBooksRepository extends ManageBooksController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllBooks()
    {
        $users = Books::all();
        return $users;
    }

    public function storeBook($book, $id = null)
    {
        $validated = $book->validate([
            'book_title' => ['required', 'string', 'max:255'],
            'total_books' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'desc' => ['required'],
            'published' => ['required'],
        ]);

        //  Request File
        if($id) {
            if($book->hasFile('image')){
                $name = $book->file('image')->getClientOriginalName();
                $fileName = time().'_'.$name;
                $book->file('image')->storeAs('public/images', $fileName);
            }else{
                $fileName = $id->image;
            }
        }else{
            if($book->hasFile('image')){
                $name = $book->file('image')->getClientOriginalName();
                $fileName = time().'_'.$name;
                $book->file('image')->storeAs('public/images', $fileName);
            }else{
               $fileName = 'No Image';
            }
        }
       
        if($id) {
            $id->update([
                'book_title' =>  $validated ['book_title'],
                'total_books' =>  $validated ['total_books'],
                'author' =>  $validated ['author'],
                'published' =>  $validated ['published'],
                'desc' =>  $validated ['desc'],
                'image' => $fileName,
            ]);
        }else{
            Books::create([
                'book_title' =>  $validated ['book_title'],
                'image' => $fileName,
                'published' =>  $validated ['published'],
                'available' => $validated ['total_books'],
                'borrowed' => 0,
                'total_books' => $validated ['total_books'],
                'desc' =>  $validated ['desc'],
                'author' =>  $validated ['author'],
            ]);  
        }

        return;
    }

    public function borrowBook($book)
    {
        $book->update([
            'available' => $book->available - 1,
            'borrowed' => $book->borrowed + 1,
        ]);
        return;
    }

    public function deleteBooks($book)
    {
        $book->delete();
        return;
    }
}
