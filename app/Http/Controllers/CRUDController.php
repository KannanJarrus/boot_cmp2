<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CRUDController extends Controller
{
    private function getData()
    {
        return session('data', []);
    }

    private function setData($data)
    {
        session(['data' => $data]);
    }

    public function index()
    {
        $data = $this->getData();

        // Check if the request is a POST (indicating form submission)
        if (request()->isMethod('post')) {
            $formData = request()->all();

            // If the request contains an 'id', it means we are updating an existing item
            if (isset($formData['id'])) {
                $id = $formData['id'];
                if (isset($data[$id])) {
                    $data[$id] = $formData;
                }
            } else {
                // Otherwise, we are creating a new item
                $data[] = $formData;
            }

            $this->setData($data);
            return redirect('crud')->with('success', 'Item saved successfully.');
        }

        // Check if the request contains flashed data
        if (session()->has('flash_message')) {
            $flashMessage = session('flash_message');
            session()->forget('flash_message');
        }

        return view('crud.index', compact('data', 'flashMessage'));
    }

    public function create()
    {
        return view('crud.create');
    }

    public function show($id)
    {
        $data = $this->getData();
        if (isset($data[$id])) {
            $item = $data[$id];
            return view('crud.show', compact('item'));
        } else {
            return redirect('crud')->with('error', 'Item not found.');
        }
    }

    public function edit($id)
    {
        $data = $this->getData();
        if (isset($data[$id])) {
            $item = $data[$id];
            return view('crud.edit', compact('item', 'id'));
        } else {
            return redirect('crud')->with('error', 'Item not found.');
        }
    }

    public function destroy($id)
    {
        $data = $this->getData();
        if (isset($data[$id])) {
            unset($data[$id]);
            $this->setData($data);
            return redirect('crud')->with('success', 'Item deleted successfully.');
        } else {
            return redirect('crud')->with('error', 'Item not found.');
        }
    }

    public function flash(Request $request)
    {
        $flashData = $request->all();
        session()->flash('flash_message', $flashData);
        return redirect('crud');
    }
}
