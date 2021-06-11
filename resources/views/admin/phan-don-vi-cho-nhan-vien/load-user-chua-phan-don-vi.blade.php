@extends('layouts.template.ajaxIndex')

@section('content')
<table class="table table-hover table-bordered datatable-buttons" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center"><input class="checkbox" type="checkbox" name="id_user[]"></th>
                        <th class="text-center">STT</th>
                        <th class="text-center d-none">ID</th>
                        <th class="text-center">Tên nhân viên</th>
                    </tr>
                </thead>
                <tbody>
        <?php $stt=0; ?>
        @foreach($userDonVis as $userDonVi)
        <?php $stt++; ?>
        <tr>
            <td class="text-center"><input class="checkbox" type="checkbox" name="id_user[]" data="{{$userDonVi->id}}"></td>
            <td class="text-center">{{$stt}}</td>
            <td class="d-none id">{{$userDonVi->id}}</td>
            <td class="name" @if($userDonVi->id_users_don_vi==null || $userDonVi->id_users_don_vi=='') <?php echo 'style="color:red;"'; ?> @endif>{{$userDonVi->name}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


    

<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.checkbox').on('click',function(){
            if($(this).prop('checked')==true){
                var idUsers=jQuery('#idUsers').val();
                var idUser=jQuery(this).attr('data').trim();
                //console.log(jQuery(this).attr('data').trim());
                idUsers+=idUser+';';
                jQuery('#idUsers').val(idUsers);
            }else{
                var idUsers=jQuery('#idUsers').val();
                var idUser=jQuery(this).attr('data').trim()+';';
                idUsers=idUsers.replace(idUser,'');
                jQuery('#idUsers').val(idUsers);
            }
                
        });
        
    });



</script>
@endsection