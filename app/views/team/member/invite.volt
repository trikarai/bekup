<section class="content-header">

    <h1>
        <a href={{ url('team/dashboard/index') }} class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> List
        <small>member</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Member Invitation</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Member Invitation</h3>
		</div>
        
        <div class="box-body">
            <div class="col-md-6">
				<div>
					<form action={{ url('team/member/send') }} method="post">
						<div class="form-group">
							<label for="email">talent email:</label>
							{{ email_field("email", "class": "form-control", "placeholder": "Email", "required": "required") }}
						</div>
						<div class="form-group">
							<label for="position">Invite as:</label>
							{{ text_field("position", "class": "form-control", "placeholder": "Position", "required": "required") }}
						</div>
						<div class="form-group">
							{{ check_field("is_admin") }}
							<label for="is_admin"> As Admin</label>
						</div>
						<button type="submit" class="btn btn-default">Invite to Team</button>
					</form>
				</div>
			</div>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- jQuery 2.2.0 -->
<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>

<!-- search-->
<script src="https://cdn.jsdelivr.net/g/jquery@2.2.4,bootstrap@3.3.6,mark.js@8.6.0(jquery.mark.min.js)"></script>


<script>
                        $('#teamMenu').addClass('active');
</script>