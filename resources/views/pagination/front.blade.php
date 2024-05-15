<?php
	$link_limit = 6; //pr($paginator);
	pr(Request()->parameter);
?>
<?php /* @if ($paginator->lastPage() > 1) */ ?>
 <ul class="kt-datatable__pager-nav">
    <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">				<a title="First" class="kt-datatable__pager-link kt-datatable__pager-link--first {{ ($paginator->currentPage() == 1) ? ' kt-datatable__pager-link--disabled' : '' }}" data-page="1" href="{{ ($paginator->currentPage() == 1) ? 'javascript:void(0)' : $paginator->url(1) }}" disabled="{{ ($paginator->currentPage() == 1) ? ' disabled' : false }}"><i class="flaticon2-fast-back"></i></a>			</li>		<li>				<a title="Previous" class="kt-datatable__pager-link kt-datatable__pager-link--prev {{ ($paginator->currentPage() == 1) ? ' kt-datatable__pager-link--disabled' : '' }}" href="{{ ($paginator->currentPage() == 1) ? 'javascript:void(0)' : $paginator->url($paginator->currentPage()-1) }}" data-page="{{$paginator->currentPage()-1}}" disabled="{{ ($paginator->currentPage() == 1) ? ' disabled' : false }}"><i class="flaticon2-back"	></i></a>		</li>		<?php /* <li class="pagination-item--wide first {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}" >
        <a class="pagination-link--wide first" href="{{ ($paginator->currentPage() == 1) ? 'javascript:void(0)' : $paginator->url($paginator->currentPage()-1) }}"> <span aria-hidden="true">&larr;</span> {{ trans("messages.previous") }}</a>
    </li> */ ?>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
          <?php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
               $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            ?>
            @if ($from < $i && $i < $to)				
				<li>
					<a class="kt-datatable__pager-link kt-datatable__pager-link-number {{ ($paginator->currentPage() == $i) ? ' kt-datatable__pager-link--active' : '' }}" data-page="{{ $i }}" title="1" href='{{ ($paginator->currentPage() == $i) ? "javascript:void();" : $paginator->url("$i") }}'>{{ $i }}</a>
				</li>				
                <?php /* <li class="pagination-item {{ ($paginator->currentPage() == $i) ? ' is-active' : '' }}">
                    <a class="pagination-link" href='{{ $paginator->url("$i") }}'>{{ $i }}</a>
                </li> */ ?>
            @endif
     @endfor
    <?php /* <li class="pagination-item--wide last {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a class="pagination-link--wide last" href="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'javascript:void(0)' : $paginator->url($paginator->currentPage()+1) }}" >{{ trans("messages.next") }} <span aria-hidden="true">&rarr;</span></a>
    </li> */ ?>			<li>		<a title="Next" class="kt-datatable__pager-link kt-datatable__pager-link--next {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' kt-datatable__pager-link--disabled' : ''; }}" href="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'javascript:void(0)' : $paginator->url($paginator->currentPage()+1); }}" data-page="{{$paginator->currentPage()+1}}"><i class="flaticon2-next"></i></a>	</li>		<li>		<a title="Last" class="kt-datatable__pager-link kt-datatable__pager-link--last {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' kt-datatable__pager-link--disabled' : '' }}" href="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'javascript:void(0)' : $paginator->url($paginator->lastPage()) }}" data-page="{{$paginator->lastPage()}}"><i class="flaticon2-fast-next"></i></a>	</li>		
</ul>

<div class="kt-datatable__pager-info">
  <div class="dropdown bootstrap-select kt-datatable__pager-size" style="width: 60px;">
	 <!-- <select class="selectpicker kt-datatable__pager-size" title="Select page size" data-width="60px" data-container="body" data-selected="10" tabindex="-98">
		<option class="bs-title-option" value=""></option>
		<option value="5">5</option>
		<option value="10">10</option>
		<option value="20">20</option>
		<option value="30">30</option>
		<option value="50">50</option>
		<option value="100">100</option>
	 </select>
	<button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="Select page size">
		<div class="filter-option">
		   <div class="filter-option-inner">
			  <div class="filter-option-inner-inner">10</div>
		   </div>
		</div>
	 </button>-->
	 <div class="dropdown-menu ">
		<div class="inner show" role="listbox" id="bs-select-1" tabindex="-1">
		   <ul class="dropdown-menu inner show" role="presentation"></ul>
		</div>
	 </div>
  </div>
  <?php 
	if($paginator->currentPage() == 1){
		if($paginator->total() <= $paginator->perPage()){
			$minShowing = "1";
			$maxShowing = $paginator->total();
		}else{
			$minShowing = "1";
			$maxShowing = $paginator->perPage();
		}
	}else{
		$minShowing = ($paginator->currentPage() * $paginator->perPage()) - $paginator->perPage();
		$maxShowing = $paginator->currentPage() * $paginator->perPage();
	}
	
  ?>
  
  <span class="kt-datatable__pager-detail">Showing {{$minShowing}} - {{$maxShowing}} of {{$paginator->total()}}</span>
</div>

<?php /* @endif */ ?>