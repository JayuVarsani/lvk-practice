<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModeratorFormRequest;
use App\Models\Moderator;
use App\View\Components\delete_moderator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function PHPUnit\Framework\isNull;

class ModeratorController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $searchData = $request->input('searchData') ?? '';
            $moderator = Moderator::with('media')
                ->when($request->input('searchData'), function (Builder $query, $searchData) {
                    return $query->where('name', 'like', "%{$searchData}%")
                        ->orWhere('email', 'like', "%{$searchData}%")
                        ->orWhere('status', 'like', "{$searchData}%");
                })
                ->latest('id');

            return DataTables::of($moderator)
                ->addColumn('image', function ($moderator) {
                    return $moderator->getFirstMediaUrl('moderatorImage');
                })->addColumn('action', function ($moderator) {
                    $editUrl = route('admin.moderator.edit', $moderator->id);
                    $deleteUrl = route('admin.moderator.destroy', $moderator->id);
                    return "<a href='$editUrl' >
                            <i class='fa-solid fa-pen icon edit-icon'></i></a>
                            <a href='$deleteUrl' id='delete_moderator'>
                            <i class='fa-solid fa-trash icon'></i></a>";
                })
                ->make(true);
        }
        return view('moderator.moderator-table', ['title' => 'Moderator']);
    }

    public function getData()
    {

    }

    public function create()
    {
        return view('moderator.create-moderator', ['title' => 'Create Moderator']);
    }

    public
    function store(ModeratorFormRequest $request)
    {
        $request->validated();
        $moderator = Moderator::create(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password)]);
        if ($request->file('profileImage')) {
            $moderator->addMediaFromRequest('profileImage')->toMediaCollection('moderatorImage');
        }
        session()->flash('alert', ['message' => 'Moderator Created Successfully', 'type' => 'success']);
        return redirect()->route('admin.moderator.index');
    }

    public
    function edit($id)
    {
        $moderator = Moderator::with('media')->find($id);
        return view('moderator.edit-moderator', ['title' => 'Edit Moderator', 'moderator' => $moderator]);
    }

    public
    function update(Request $request, Moderator $moderator)
    {
        $request->validate([
            'profileImage' => 'nullable|file|image|max:10240',
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:moderators,email,' . $moderator->id,
            'password' => 'nullable|max:100',
        ], [
            'profileImage.max' => 'Profile size should be less than 10MB',
        ]);
        $moderator->update(['name' => $request->name, 'email' => $request->email, 'password' => $request->password ? bcrypt($request->password) : $moderator->getRawOriginal('password')]);
        if ($request->file('profileImage')) {
            $moderator->clearMediaCollection('moderatorImage');
            $moderator->addMediaFromRequest('profileImage')->toMediaCollection('moderatorImage');
        }
        session()->flash('alert', ['message' => 'Moderator Updated Successfully', 'type' => 'success']);
        return redirect()->route('admin.moderator.index');
    }

    public
    function destroy(Moderator $moderator)
    {
        if ($moderator->delete()) {
            $moderator->clearMediaCollection('moderatorImage');
            session()->flash('alert', ['message' => 'Moderator Deleted Successfully', 'type' => 'success']);
        } else {
            session()->flash('alert', ['message' => 'Failed to Delete Moderator', 'type' => 'danger']);
        }
        return redirect()->back();
    }
}
