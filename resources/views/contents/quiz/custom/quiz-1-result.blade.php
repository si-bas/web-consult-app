<div class="card collapse-header" style="margin-bottom: 10px;">
    <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
        <h4 class="card-title">Kuis #1</h4>
    </div>
    <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">
        <div class="card-content">
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center mb-25">
                        <i class="bx bxs-notepad mr-50 cursor-pointer"></i>
                        <span>
                            Cenderung:<a href="JavaScript:void(0);">&nbsp;{{ $data->case }}</a>
                        </span>
                    </li>
                    <li class="d-flex align-items-center mb-25">
                        <i class="bx bxs-notepad mr-50 cursor-pointer"></i>
                        <span>
                            Berkode:<a href="JavaScript:void(0);">&nbsp;@foreach ($data->distortion as $key => $item)
                                {{ $item == 1 ? $key : '' }}{{ $key != 'F' && $item == 1 ? ', ' : '' }}
                            @endforeach</a>
                        </span>
                    </li>
                    <li class="d-flex align-items-center mb-25">
                        <i class="bx bxs-notepad mr-50 cursor-pointer"></i>
                        <span>
                            Rentang:<a href="JavaScript:void(0);">&nbsp;{{ $data->distortion_scale }}</a>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>