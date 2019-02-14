@extends('laraback::layouts.modal')
@section('title', 'اضافة كلية')
@section('content')
    <form method="POST" action="{{ route('colleges.add') }}" novalidate  enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="modal-body">
            <div class="form-group">
                <label for="title">الدولة</label>
                <select  class="form-control" name="nation">
                    <option class="form-control">اختار</option>
                    @foreach($nations as $nation)
                    <option value="{{$nation->id}}" class="form-control">{{$nation->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">الجامعة</label>
                <select  class="form-control" name="universty">
                    <option class="form-control">اختار</option>
                    
                </select>
			</div>
             <div class="form-group">
                <label for="title">ااسم الكلية</label>
                <input name="title" id="title" class="form-control">
            </div>
			
</div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><b>حفظ</b></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><b>تراجع</b></button>
        </div>
    </form>
    <script type="text/javascript">

  $('select[name="nation"]').change(function(){
      var nation = $(this).val();
      var token = $("input[name='_token']").val();
      $.ajax({
          url: "<?php echo route('colleges.ajax-select') ?>",
          method: 'POST',
          data: {nation:nation, _token:token},
          success: function(data) {
          
            $("select[name='universty'").html('');
            $("select[name='universty'").html(data.options);
          }
      });
  });
</script>
@endsection

