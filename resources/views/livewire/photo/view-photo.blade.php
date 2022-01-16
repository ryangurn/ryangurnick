<div class="bg-transparent">
    <div class="flex">
        <img class="object-cover shadow-lg rounded-lg" src="{{ $photo->image->file }}">
        @if (!$user_reactions->isEmpty() && $allow_reactions)
        <div  class="flex flex-col content-start justify-start m-auto absolute h-1 inset-0 mt-2 ml-2 mr-2">
            <div class="grid grid-cols-10">
                @foreach($user_reactions as $reaction)
                <div class="col-span-1">
                    <span class="inline-flex items-center p-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                    {{ $reaction->reaction->icon }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    <div class="m-2 bg-transparent">
        <div class="flex">
            @if (isset($photo->location) && $photo->location != null)
                <span class="float-right inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                        <circle cx="4" cy="4" r="3" />
                    </svg>
                    {{ $photo->location }}
                </span>
            @endif
            @if (isset($photo->date) && $photo->date != null)
                <span class="float-right inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 {{ (isset($photo->location) && $photo->location != null) ? 'ml-2' : '' }}">
                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                        <circle cx="4" cy="4" r="3" />
                    </svg>
                    {{ Carbon\Carbon::parse($photo->date)->diffForHumans() }}
                </span>
            @endif
        </div>
        <div class="text-lg leading-6 font-medium space-y-1 dark:text-gray-300">
            <p>
                {{ $photo->caption }}
            </p>
            @auth
                @if ($allow_reactions && auth()->user()->can('react to photo'))
            <div class="grid grid-cols-10 gap-2 mt-4 mb-4" x-data="{ show_reactions: @entangle('show_reactions') }">
                <a href="#" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="$toggle('show_reactions')">
                    react
                </a>

                @if (!$reactions->isEmpty())
                    @foreach($reactions as $reaction)
                    <div class="col-span-1 cursor-pointer" x-show="show_reactions">
                        <span class="inline-flex items-center p-1 rounded-full text-sm font-medium {{ ($active_reaction != null && $active_reaction->reaction_id == $reaction->id) ? 'bg-indigo-600' : 'bg-gray-100' }} text-gray-800" wire:click="react({{$reaction->id}})">
                        {{ $reaction->icon }}
                        </span>
                    </div>
                    @endforeach
                @endif
            </div>
                @endif

                @if ($allow_comments)
            <div>
                @if (auth()->user()->can('comment on photo'))
                <hr />
                <div class="flex items-start space-x-4 pt-2">
                    <div class="flex-shrink-0">
                        <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?d=mp" alt="avatar" class="inline-block h-10 w-10 rounded-full" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="border-b border-gray-200 focus-within:border-indigo-600">
                            <label for="comment" class="sr-only">Add your comment</label>
                            <textarea rows="3" name="comment" id="comment" class="block dark:text-gray-400 dark:bg-gray-900 dark:placeholder-gray-300 dark:border-gray-700 w-full border-0 border-b border-transparent p-0 pb-2 resize-none focus:ring-0 focus:border-indigo-600 sm:text-sm" placeholder="Add your comment..." wire:model="comment"></textarea>
                        </div>
                        <div class="pt-2 flex justify-between">
                            <div class="flex-shrink-0">
                                <button type="submit" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="comment">
                                    comment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan

                <div class="pt-3">
                    <hr />
                    <ul role="list" class="divide-y divide-gray-200">
                        @if (!$comments->isEmpty())
                            @foreach ($comments as $comment)
                        <li class="py-4">
                            <div class="flex space-x-3">
                                <img class="h-6 w-6 rounded-full" src="https://www.gravatar.com/avatar/{{ md5($comment->user->email) }}?d=mp" alt="">
                                <div class="flex-1 space-y-1">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-medium dark:text-gray-300">{{ $comment->user->name }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->updated_at->diffForHumans() }}</p>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->message }}</p>
                                </div>
                            </div>
                        </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

            </div>
                @endif
            @endauth
        </div>
    </div>
</div>
