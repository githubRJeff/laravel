<!-- 成功提示框 -->
@if (Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span> {{ Session::get('success') }}
    </button>
    <strong>成功!</strong> 操作成功提示！
</div>
@endif
@if (Session::has('error'))
<!-- 失败提示框 -->
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span> {{ Session::get('error') }}
    </button>
    <strong>失败!</strong> 操作失败提示！
</div>
@endif