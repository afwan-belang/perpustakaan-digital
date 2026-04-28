<form action="{{ route('home') }}" method="GET" class="relative w-full md:w-80">
    @if(request('category_id'))
        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
    @endif

    <input type="text" name="search" value="{{ request('search') }}" 
           placeholder="Cari judul atau penulis..." 
           class="w-full pl-11 pr-10 py-2.5 rounded-xl border border-slate-800 bg-slate-900 text-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 placeholder-slate-500 shadow-inner">
    
    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
    </div>
    
    @if(request('search'))
        <a href="{{ route('home', ['category_id' => request('category_id')]) }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-red-400 transition-colors" title="Hapus pencarian">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </a>
    @endif
</form>