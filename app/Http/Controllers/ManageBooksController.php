<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\ManageBooks\ManageBooksRepository;
use App\Models\Books;

class ManageBooksController extends Controller
{

    protected $manageBooks;
    public function __construct()
    {
        $this->middleware('auth');
        $this->manageBooks= new ManageBooksRepository();
    }

    public function index()
    {
        $books = $this->manageBooks->getAllBooks();
        return view('manage-books.index', compact('books'));
    }

    public function create(Books $id) 
    {
        if($id->id == null){
            return view('manage-books.create');
        }else{
            return view('manage-books.create', compact('id'));
        }   
    }

    public function store(Request $request)
    {
        $this->manageBooks->storeBook($request);
        return redirect()->route('books.index');
    }

    public function update(Request $request, Books $id)
    {
        $this->manageBooks->storeBook($request, $id);
        return redirect()->route('books.index');
    }

    public function show(Books $id)
    {
        return view('manage-books.show', compact('id'));
    }

    public function borrow(Books $id)
    {
        $this->manageBooks->borrowBook($id);
        return redirect()->back();
    }

    public function destroy(Books $id)
    {
        $this->manageBooks->deleteBooks($id);
        return redirect()->route('books.index');
    }

}
