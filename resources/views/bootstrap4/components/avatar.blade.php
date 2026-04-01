<div class="d-inline-flex align-items-center position-relative">
    @if($src)
        <img src="{{ $src }}" alt="{{ $alt ?? '' }}" class="{{ $rounded ? 'rounded-circle' : 'rounded' }}" style="width:{{ match($size) { 'xs'=>'24px','sm'=>'32px','md'=>'40px','lg'=>'48px','xl'=>'64px','2xl'=>'80px',default=>'40px' } }};height:{{ match($size) { 'xs'=>'24px','sm'=>'32px','md'=>'40px','lg'=>'48px','xl'=>'64px','2xl'=>'80px',default=>'40px' } }};object-fit:cover" loading="lazy" />
    @else
        <span class="d-inline-flex align-items-center justify-content-center {{ $rounded ? 'rounded-circle' : 'rounded' }} bg-secondary text-white font-weight-bold" style="width:{{ match($size) { 'xs'=>'24px','sm'=>'32px','md'=>'40px','lg'=>'48px','xl'=>'64px','2xl'=>'80px',default=>'40px' } }};height:{{ match($size) { 'xs'=>'24px','sm'=>'32px','md'=>'40px','lg'=>'48px','xl'=>'64px','2xl'=>'80px',default=>'40px' } }}">{{ $computedInitials() }}</span>
    @endif
    @if($status)
        <span class="position-absolute rounded-circle border border-white {{ match($status) { 'online'=>'bg-success','away'=>'bg-warning','busy'=>'bg-danger',default=>'bg-secondary' } }}" style="width:10px;height:10px;bottom:0;right:0"></span>
    @endif
</div>
