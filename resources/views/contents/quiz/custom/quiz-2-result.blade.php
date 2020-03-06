<div class="card collapse-header" style="margin-bottom: 10px;">
    <div id="headingCollapse2" class="card-header" data-toggle="collapse" role="button" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
        <h4 class="card-title">Kuis #2</h4>
    </div>
    <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse">
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
                            Komponen A:<a href="JavaScript:void(0);">&nbsp;{{ array_sum($data->component['A']) }}</a>
                        </span>
                    </li>
                    <li class="d-flex align-items-center mb-25">
                        <i class="bx bxs-notepad mr-50 cursor-pointer"></i>
                        <span>
                            Komponen B:<a href="JavaScript:void(0);">&nbsp;{{ array_sum($data->component['B']) }}</a>
                        </span>
                    </li>
                    <li class="d-flex align-items-center mb-25">
                        <i class="bx bxs-notepad mr-50 cursor-pointer"></i>
                        <span>
                            Kesimpulan:<a href="JavaScript:void(0);">&nbsp; {{ array_sum($data->component['A']) > array_sum($data->component['B']) ? 'Motivasi Spiritual Rendah' : '' }}{{ array_sum($data->component['A']) < array_sum($data->component['B']) ? 'Motivasi Spiritual Tinggi' : '' }}</a>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>