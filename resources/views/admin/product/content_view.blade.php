@if(count($pro))
    <table id="viewProduct" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th class="center">No</th>
            <th class="center">Photo</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Category</th>
            <th>Create By</th>
            <th style="width:20%; !important;" class="center">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php $i=1;?>
            @foreach($pro as $p)
                <td style="line-height: 50px;" class="center">{{$i++}}</td>
                <td class="center"><img src='{{asset("mainProduct/$p->photo")}}' alt="no image" style="background: white;border:2px solid #00A6C7;border-radius: 50px;padding:1px;height: 50px; width: 50px;"></td>
                <td style="line-height: 50px">{{$p->pivot->name}}</td>
                <td style="line-height: 50px">{{$p->brand->name}}</td>
                <td style="line-height: 50px">
                    @foreach($p->categoryproduct->languages()->where('language_id',$lang)->get() as $c)
                        {!! $c->pivot->name !!}
                    @endforeach
                </td>
                <td style="line-height: 50px">{{$p->user->name}}</td>
                <td style="line-height: 50px" class="center">

                    <a href="{{route('product.edit',$p->id)}}" style="padding: 5px;"><i class="fa fa-edit"></i></a>
                    <a href="#" style="padding: 5px;" onclick='deletePro("{{$p->id}}")'><i class="fa fa-trash" style="color: red;"></i></a>
                    <a href="#" onclick='viewPro("{{$p->id}}")' data-toggle="modal" data-target=".bs-example-modal-lg" style="padding: 5px;" data-toggle="modal" data-target="#viewUser" style="padding: 5px;"><i class="fa fa-eye" style=""></i></a>

                </td>
        </tr>

        @endforeach
        </tbody>
    </table>

@else
    <h5 class="center">No record view</h5>
@endif