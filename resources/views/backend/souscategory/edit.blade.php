@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Modifier sous sous-catégorie</h4>
                    <!-- /.box-title -->
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach

                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="card-content">
                        <form action="{{route('souscategory.update',$category->id)}}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom sous sous-catégorie <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required value="{{$category->title}}" name="title">
                            </div>

                            <div class="form-group margin-bottom-20" id="parent_cat_div">
                                <label for="parent_id">Grand catégorie</label>
                                <select id="cat_id" class="form-control" name="grand_cat_id" required >
                                        @foreach ($parent_cats as $pcats)
                                            <option value="{{$pcats->id}}" {{$pcats->id==$category->grand_cat_id ? 'selected' : ''}}>{{$pcats->title}}</option>
                                        @endforeach
                                </select>
                            </div>

                            <div id="child_cat_div" class="form-group margin-bottom-20 display-none">
                                <label for="exampleInputEmail1">Sous-catégories</label>
                                <select id="child_cat_id" class="form-control" name="sous_cat_id">

                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    var child_cat_id = {{$category->sous_cat_id}};
    $('#cat_id').change(function(){
      var cat_id=$(this).val();
     // alert(cat_id);
      if(cat_id != null){
          $.ajax({
              url: "/admin/souscategory/"+cat_id+"/child",
              type: "POST",
              data:{
                  _token:"{{csrf_token()}}",
                  cat_id:cat_id
              },
              success:function(response){
                  var html_option="";
                  if(response.status){
                      $('#child_cat_div').removeClass('display-none');
                      $.each(response.data,function(id,title){
                          html_option +="<option value='"+id+"' "+(child_cat_id==id ? 'selected' : '')+">"+title+"</option>"
                      });
                  }
                  else{
                      $('#child_cat_div').addClass('display-none');
                  }
                  $('#child_cat_id').html(html_option);
                  $('#child_cat_id').change();
              }
          });
      }


    });
    if(child_cat_id !=null){
       $('#cat_id').change();
   }
</script>

@endsection
