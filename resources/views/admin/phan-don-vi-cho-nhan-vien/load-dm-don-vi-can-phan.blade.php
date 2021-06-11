@extends('layouts.template.ajaxIndex')

@section('content')
<?php $idDonVi=Auth::user()->id_don_vi; ?>
<ul id="tree1">
    <?php 
    $shareDonVi='';
    foreach ($donVis as $key => $donVi) {
        if($donVi['id']==$idDonVi){
            $shareDonVi.=$donVi['id'].';';
        ?>
            <li data="{{$donVi['id']}}"><a href="#">{{ $donVi['ten_don_vi'] }}</a>
            <?php $shareDonVi.=\Helper::exportTree($donVis,$idDonVi); ?>
            </li>
        <?php
        }
    }
    ?>                                           
</ul>

    

<script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        // tree
    $.fn.extend({
                treed: function (o) {
                  
                  var openedClass = 'mdi mdi-plus-circle';
                  var closedClass = 'mdi mdi-minus-circle';
                  
                  if (typeof o != 'undefined'){
                    if (typeof o.openedClass != 'undefined'){
                    openedClass = o.openedClass;
                    }
                    if (typeof o.closedClass != 'undefined'){
                    closedClass = o.closedClass;
                    }
                  };
                  
                    //initialize each of the top levels
                    var tree = $(this);
                    tree.addClass("tree");
                    tree.find('li').has("ul").each(function () {
                        var branch = $(this); //li with children ul
                        // kiểm tra nếu là user thì không cần in dấu + -
                        var idDonVi=jQuery(this).attr('data').trim();
                        if(!jQuery.isNumeric(idDonVi)){
                            branch.prepend("&nbsp;&nbsp;");
                        }else{
                            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                        }

                        
                        branch.addClass('branch');
                        branch.css('cursor','pointer');
                    });

                    tree.find('li').each(function () {
                        var branch = $(this); //li with children ul
                        var idDonVi=jQuery(this).attr('data').trim();
                        if(!jQuery.isNumeric(idDonVi)){
                            idDonVi='';
                        }else{
                            branch.prepend("<input type='radio' data='"+idDonVi+"' name='radio' class='radio'>");
                        }
                        
                        branch.on('click', function (e) {
                            if (this == e.target) {
                                var icon = $(this).children('i:first');
                                icon.toggleClass(openedClass + " " + closedClass);
                                $(this).children().children().toggle();
                            }
                        })
                        branch.children().children().toggle();
                    });
                    //fire event from the dynamically added icon
                  tree.find('.branch .indicator').each(function(){
                    $(this).on('click', function () {
                        $(this).closest('li').click();
                    });
                  });
                    //fire event to open branch if the li contains an anchor instead of text
                    tree.find('.branch>a').each(function () {
                        $(this).on('click', function (e) {
                            $(this).closest('li').click();
                            e.preventDefault();
                        });
                    });
                    //fire event to open branch if the li contains a button instead of text
                    tree.find('.branch>button').each(function () {
                        $(this).on('click', function (e) {
                            $(this).closest('li').click();
                            e.preventDefault();
                        });
                    });


                }
            });


            //Initialization of treeviews

            $('#tree1').treed();
            $('li.tree-show').css('display','block');
            jQuery('.radio').on('click',function(){
                var idDonVi=jQuery(this).attr('data').trim();
                jQuery('#idDonVi').val(idDonVi);
            });


        
    });



</script>
@endsection