<x-admin :title="'Player Details'">
<x-alert type="success" />
    <div class="link-grid">
        <div class="col-span-2 px-4 py-6 mx-13">
            <x-player-card :player="$player" />
        </div>
        <div class="col-span-2">
            <div>
                <div class="z-50 absolute right-16 flex flex-row gap-2">
                    <x-home-button/>
                    <x-back-button/>
                </div>
                <div class="inverted-radius my-5 relative">
                    <div class="inverted-radius-content">
                        <div class="flex flex-wrap items-center gap-2 mb-4">
                            <div class="frame-dot green-bg"></div>
                            <div class="frame-dot gold-bg"></div>
                            <div class="frame-dot red-bg"></div>
                        </div>
                        <div class="frame-wrapper">
                            <p>This is how the a player is displayed on the website. Please make sure all the information is correct. if you have any issues with the tournament you can perform the following commands:
                            </p>
                            <div class="link-grid-item mb-4">
                                <div>
                                    <div class="text-sm">Add to Website</div>
                                    <div class="text-2xl font-semibold">Edit Player</div>
                                    <a href="{{ route('admin.players.edit', $player->id) }}"><button class="green-red-btn">Update Player <span><i class="fa-solid fa-pen-to-square text-sm"></i></span></button></a>
                                </div>
                                <div class="link-grid-icon">
                                    <i class="fas fa-clipboard text-xl"></i>
                                </div>
                            </div>
                            <div class="link-grid-item">
                                <div>
                                    <div class="text-sm">Add to Website</div>
                                    <div class="text-2xl font-semibold">Delete Player</div>
                                    <form action="{{ route('admin.players.destroy', $player->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this player?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="green-red-btn">
                                            Delete Player
                                        <i class="ml-10 text-sm fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="link-grid-icon">
                                    <i class="fas fa-x text-xl"></i>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin>
