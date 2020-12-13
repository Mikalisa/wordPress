<form role="search" method="get" id="searchform-content" action="<?php echo esc_url( home_url('/') ); ?>">


<div class="input-group">
        <input type="text" value="" name="s" class="smartlib-form-control"
               placeholder="<?php esc_attr_e('Search', 'blogrock-core'); ?>">

<span class="input-group-btn">
    <button class="btn btn-default">
        <i class="fa fa-search"></i>
    </button>

    </span>
</div>

</form>