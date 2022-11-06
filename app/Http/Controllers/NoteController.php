<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Category;
use App\Models\Note;
use App\Models\NoteCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function overview(): View
    {
        return view(
            'note.list',
            [
                'notes' => Auth::user()->notes,
            ]
        );
    }

    public function create(): View
    {
        return view(
            'note.form',
            [
                'categories' => $this->getCategoriesArray(Auth::user()),
            ]
        );
    }

    public function view(int $note_id): View
    {
        $user = Auth::user();
        $note = $user->notes()
            ->where('id', $note_id)
            ->firstOrFail();

        $categories = $this->getCategoriesArray($user, $note);
        return view(
            'note.form',
            [
                'note' => $note,
                'categories' => $categories,
            ]
        );
    }

    public function store(NoteRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $categories = $validated['categories'] ?? [];
        unset($validated['categories']);

        $note = Note::create(
            array_merge(
                ['user_id' => Auth::id()],
                $validated
            )
        );

        $this->associateCategories($categories, $note->id);

        return redirect(route('note.list'))->with('status', 'Note Saved');
    }

    public function update(int $note_id, NoteRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $categories = $validated['categories'] ?? [];
        unset($validated['categories']);

        $note = Note::updateOrCreate(
            [
                'id' => $note_id,
                'user_id' => Auth::id(),
            ],
            $validated
        );

        $note->noteCategories()->delete();
        $this->associateCategories($categories, $note_id);

        return redirect(route('note.list'))->with('status', 'Note Saved');
    }

    private function getCategoriesArray(User $user, ?Note $note = null): array
    {
        $lazyCollection = $user->categories()->cursor();
        $selected = $note ? $note->categories : collect([]);

        return $lazyCollection->map(
            function (Category $category) use ($selected) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'selected' => $selected->where('id', $category->id)->isNotEmpty(),
                ];
            }
        )->toArray();
    }

    private function associateCategories(array $categories, int $note_id): void
    {
        foreach ($categories as $category_id => $bool)
        {
            NoteCategory::firstOrCreate(
                [
                    'note_id' => $note_id,
                    'category_id' => $category_id
                ]
            );
        }
    }
}
