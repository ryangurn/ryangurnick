<x-app-layout>
    <div class="cards-container space-y-6 my-6">
        <div class="card-container shadow-sm hover:shadow-md transition duration-150 ease-in bg-white rounded-xl flex">
            <div class="border-r border-gray-100 px-5 py-8 w-1/5">
                <div class="text-left">
                    <span class="text-lg">gallery</span>
                </div>
            </div>

            <div class="flex px-2 py-6 w-full">
                <div class="mx-4 w-full">
                    <div class="text-gray-600 mt-3">
                        <p class="pb-2">This has been a long time coming. Sharing photos is quite important to me, and in a world in which social networks treat their users as the product not the customer it is time to take that control back.</p>

                        <p class="pb-2">This photos page is meant to provide some freedom from advertisements, data theft and monitoring from social networks. I hope you will value both the pictures posted here. In addition to the ability to look at my photos without being tracked by anyone. This page is in chronological order with the newest pictures at the top and oldest at the bottom, with no special algorithms.</p>

                        <p class="pb-2">This page is a continual work in progress. Please bare with me as I shake out the method to this madness. Once this page is complete, so is my time with instagram.</p>

                        <p class="pb-2">I hope you enjoy!</p>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-gray-400 text-xs font-semibold space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>home</div>
                        </div>

                        <div class="flex items-center space-x-2">
                            <div class="bg-gray-100 hover:bg-gray-200 text-xxs font-bold leading-none rounded-full text-center w-28 h-7 py-2 px-4">
                                edit
                            </div>
                            <button class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                                <ul class="hidden absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 ml-8">
                                     <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a></li>
                                     <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ul role="list" class="space-y-12 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 sm:space-y-0 lg:grid-cols-3 lg:gap-x-8">
            <li>
              <div class="space-y-4">
                <div class="aspect-w-3 aspect-h-2">
                  <img class="object-cover shadow-lg rounded-lg" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80" alt="">
                </div>

                <div class="space-y-2">
                  <div class="text-lg leading-6 font-medium space-y-1">
                    <p>description here</p>
                  </div>
                  <ul role="list" class="flex space-x-5">
                    <li>
                      <div class="flex items-center text-gray-400 text-xs font-semibold space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>home</div>
                        </div>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
        </ul>
    </div>
</x-app-layout>
