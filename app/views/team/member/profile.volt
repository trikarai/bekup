<?php use Phalcon\Tag; ?>

<style>
    td {
        width:20%;
    }
</style>

{{ content() }}
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href={{ url('team/member/invite') }} class="btn tomboladd"><i class="fa fa-reply" aria-hidden="true"></i> back</a> Team
        <small>profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Invite to team</li>
    </ol>


</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-2">
                    <h3 class="box-title" style="vertical-align: -webkit-baseline-middle;">Basic Info</h3>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <label class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-8">
                            <div>{{ talentRdo.getName() }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-8">
                            <div>{{ talentRdo.getEmail() }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 control-label">Phone</label>
                        <div class="col-sm-8">
                            <div>{{ talentRdo.getPhone() }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 control-label">City</label>
                        <div class="col-sm-8">
                            <div>{{ talentRdo.cityRdo().getName() }}</div>
                        </div>
                    </div>
					<?php $trackRdo = $talentRdo->trackRdo(); ?>
					{% if trackRdo is not empty %}
						<div class="row">
							<label  class="col-sm-4 control-label">Track</label>
							<div class="col-sm-8">
								<div>{{ trackRdo.getName() }}</div>
							</div>
						</div>
					{% endif %}
                    <div class="row">
                        <label  class="col-sm-4 control-label">Birth Date</label>
                        <div class="col-sm-8">
                            <div>{{ talentRdo.getBirthDate() }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <label  class="col-sm-4 control-label">City of Origin</label>
                        <div class="col-sm-8">
                            <div>{{ talentRdo.getCityOfOrigin() }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <form action={{ url('team/member/send') }} method="post">
                            {{ hidden_field("talent_id", "value": talentRdo.getId()) }}
                            <div class="form-group">
                                <label for="position">Invite as:</label>
                                {{ text_field("position", "class": "form-control", "placeholder": "Position", "required": "required", "style": "width:50%") }}
                            </div>
                            <div class="form-group">
                                {{ check_field("is_admin") }}
                                <label for="is_admin"> As Admin</label>
                            </div>
                            <button type="submit" class="btn tomboladd"><i class="fa fa-plus"></i> Invite to Team</button>
                        </form>
                    </div>
                </div>
            </div>

            <hr/>
            <!-- / .tab pane -->
            <!-- Work JOb History Table -->
            <h5 class="header-label"> Job History </h5>
            <table id="table" class="table table-hover table-mc-light-blue">
                <thead style="font-weight:bold;">
                    <tr>
                        <td>Company Name</td>
                        <td>Position</td>
                        <td>Working Time</td>
                        <td>Role</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if(@$jobHistoryDTOs):?>
                    <?php $i = 0; ?>
                    <?php foreach ($jobHistoryDTOs as $row) :?>
                    <tr>
                        <td data-title="Company Name"> <?php echo $row->companyName(); ?> </td>
                        <td data-title="Position"> <?php echo $row->position(); ?> </td>
                        <td data-title="Working Time"> <?php echo $row->startWorkingTime(); ?> - <?php echo $row->endWorkingTime(); ?> </td>
                        <td data-title="Role"> <?php echo $row->role(); ?> </td>
                        <td></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach?>
                    <?php else:?>
                    <tr>
                        <td colspan="5" align="center" class="center-status-team">No Job History Data</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <hr/>
            <!-- Training History Table -->
            <h5 class="header-label"> Training Experience </h5>
            <table id="table" class="table table-hover table-mc-light-blue">
                <thead style="font-weight:bold";>
                    <tr>
                        <td>Name</td>
                        <td>Organizer</td>
                        <td>Year</td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if(@$trainingHistoryDTOs):?>
                    <?php $t=1; ?>
                    <?php foreach ($trainingHistoryDTOs as $row) :?>
                    <tr>
                        <td data-title="Name"> <?php echo $row->name(); ?> </td>
                        <td data-title="Organizer"> <?php echo $row->organizer(); ?> </td>
                        <td data-title="Year"> <?php echo $row->year(); ?> </td>
                        <td></td>
                        <td></td>
                        </td>
                    </tr>
                    <?php endforeach?>
                    <?php else:?>
                    <tr>
                        <td colspan="5" align="center" class="center-status-team">No Training Data</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <hr/>

            <!-- Education History Table -->
            <h5 class="header-label"> Education History </h5>
            <table id="table" class="table table-hover table-mc-light-blue">
                <thead style="font-weight:bold;">
                    <tr>
                        <td>Phase</td>
                        <td>Institution</td>
                        <td>Major</td>
                        <td>Start Year</td>
                        <td>End Year</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if(@$educationHistoryDTOs):?>
                    <?php foreach ($educationHistoryDTOs as $row) :?>
                    <tr>
                        <td data-title="Phase"> <?php echo $row->phase(); ?> </td>
                        <td data-title="Institution"> <?php echo $row->institution(); ?> </td>
                        <td data-title="Major"> <?php echo $row->major(); ?> </td>
                        <td data-title="Start Year"> <?php echo $row->startYear(); ?> </td>
                        <td data-title="End Year"> <?php echo $row->endYear(); ?> </td>

                    </tr>
                    <?php endforeach?>
                    <?php else:?>
                    <tr>
                        <td colspan="5" align="center" class="center-status-team">No Education History Data</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <hr/>
            <!-- Skill -->
            <h5 class="header-label"> Skill</h5>
            <table id="table" class="table table-hover table-mc-light-blue">
                <thead style="font-weight:bold;">
                    <tr>
                        <td>Skill</td>
                        <td>Score</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if(@$skillSetDTOs):?>
                    <?php foreach ($skillSetDTOs as $row) :?>
                    <tr>
                        <td data-title="Skill"> <?php echo $row->querySkillDTO()->type() . " - " . $row->querySkillDTO()->name(); ?> </td>
                        <td data-title="Score"> <?php echo $row->score(); ?> </td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>

                    <?php endforeach?>
                    <?php else:?>
                    <tr>
                        <td colspan="5" align="center" class="center-status-team">No Skillset Data</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <hr/>
            <!-- Certificate Data -->
            <h5 class="header-label"> Certificate </h5>
            <table id="table" class="table table-hover table-mc-light-blue">
                <thead style="font-weight:bold;">
                    <tr>
                        <td>Certificate Name</td>
                        <td>Organizer</td>
                        <td>Valid Until</td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if(@$certificateDTOs):?>
                    <?php foreach ($certificateDTOs as $row) :?>
                    <tr>
                        <td data-title="Certificate Name"> <?php echo $row->name(); ?> </td>
                        <td data-title="Organizer"> <?php echo $row->organizer(); ?> </td>
                        <td data-title="Valid Until"> <?php echo $row->validUntil(); ?> </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php endforeach?>
                    <?php else:?>
                    <tr>
                        <td colspan="5" align="center" class="center-status-team">No Certificate Owned Data</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>




        </div>

        <!-- /.box-body -->
        <div class="box-footer">

        </div>
    </div>
    <!-- /.box-footer-->

    <!-- /.box -->

</section>
<!-- /.content -->

<!-- jQuery 2.2.0 -->
<script src="<?php echo $this->url->get('public'); ?>/js/jQuery-2.2.0.min.js"></script>


<script>
    $('#teamMenu').addClass('active');
    $('#teamMenu').css('color', '#fff');
</script>
