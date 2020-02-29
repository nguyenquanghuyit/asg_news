<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
            Menu
        </li>
        @foreach($theLoai as $tl)
            <li href="#" class="list-group-item menu1">
                {{$tl->Ten}}
            </li>
            @if(count($tl->loaitin)>0)
                <ul style="display: none;">
                    @foreach($tl->loaitin as $lt)
                        <li class="list-group-item">
                            <a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html">{{$lt->Ten}}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
    </ul>
    @endforeach
</div>