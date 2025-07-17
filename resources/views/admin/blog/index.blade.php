<x-admin :title="'News Overview'">
<x-alert type="success" />

    <div class="link-grid">
        <div class="col-span-1">
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Add to Website</div>
                    <div class="text-2xl font-semibold">Add A Blog Post</div>
                    <a href="{{ route('admin.blog.create') }}">
                        <div class="grid-link-btn">
                            Explore More
                        </div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-plus-circle text-xl"></i>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Add to Website</div>
                    <div class="text-2xl font-semibold">View All Articles</div>
                    <a href="">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-eye text-xl"></i>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Add to Website</div>
                    <div class="text-2xl font-semibold">Update A Player</div>
                    <a href="#blogSection">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Add to Website</div>
                    <div class="text-2xl font-semibold">Delete An Article</div>
                    <a href="#blogSection">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-history text-xl"></i>
                </div>
            </div>
        </div>
    </div> 
    <div>
      <div class="inverted-radius my-5 relative" id="blogSection">
        <div class="inverted-radius-content">
          <!-- Filter + Table Section -->
          <div class="flex flex-wrap items-center gap-2 mb-4">
            <div class="search-tab">
              <input type="text" placeholder="Search" class="search-input table-search" />
              <span class="search-icon"><i class="fas fa-search"></i></span>
            </div>
          </div>
      
          <!-- Table -->
          <div class="table-wrapper">
          <!-- (Insert same table HTML from previous step here) -->
          <table class="admin-table searchable-table">
            <thead>
              <tr>
                <th>Headline</th>
                <th>Category</th>
                <th>Author</th>
                <th>Thumbnail</th>
                <th>Created On</th>
                <th>Updated On</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @forelse ($blog as $blogs)
              @php
                $created = \Carbon\Carbon::parse($blogs->created_at);
                $updated = \Carbon\Carbon::parse($blogs->updated_at);
              @endphp
              <tr>
                <td>{{ $blogs->headline }}</td>
                <td>{{ $blogs->category }}</td>
                <td>{{ $blogs->author }}</td>
                <td>
                <img src="{{ asset('storage/' . $blogs->thumbnail) }}" 
                    alt="BLog Image" 
                    class="w-10 h-10 rounded-full object-cover" />
                </td>
                <td>{{ \Carbon\Carbon::parse($blogs->created_at)->format('d M, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($blogs->updated_at)->format('d M, Y') }}</td>
                <td>
                <td class="flex gap-2 items-center justify-center">
                  <a href="{{ route('admin.blog.show', $blogs->id) }}" class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                    <i class="text-sm fa-solid fa-eye"></i>
                  </a>
                  <a href="{{ route('admin.blog.edit', $blogs->id) }}" class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                    <i class="text-sm fa-solid fa-clipboard"></i>
                  </a>
                  <form action="{{ route('admin.blog.destroy', $blogs->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-10 h-10 trash-btn rounded-full flex items-center justify-center">
                      <i class="text-sm fa-solid fa-trash"></i>
                    </button>
                  </form> 
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center py-4">No articles found.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
          </div>
          <div class="mt-4">
              {{ $blog->links('vendor.pagination.adminpagination') }}
          </div>
        </div>
      </div>
    </div> 
</x-admin>