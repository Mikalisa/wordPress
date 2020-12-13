<form id="searchForm" class="navbar-form navbar-left" action="<?php echo esc_url( home_url('/') ); ?>" method="get" role="search">
    <div class="input-group">
        <input type="text" class="form-control pull-right" name="s" placeholder="<?php esc_attr_e( 'Search for ...', 'blogrock-core' ); ?>">
						<span class="input-group-btn">
							<button type="reset" class="btn btn-default smartlib-square-btn">
                                <i class="fa fa-times"></i>
                            </button>
							<button type="submit" class="btn btn-primary smartlib-square-btn">
                                <i class="fa fa-search"></i>
                            </button>
						</span>
    </div>
</form>