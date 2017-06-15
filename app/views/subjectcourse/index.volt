<?php use Phalcon\Tag; ?>

{{ content() }}

<h1>Course</h1>

<div align="right">
    <?php echo Tag::hiddenField(array("id")); ?>
    <!--{{ link_to("course/new", "Add Skill", "class": "btn btn-primary") }}-->
	<a href='<?php echo $this->url->get('subjectcourse/new/'.$subjectId);?>' class="btn btn-primary">Add Course</a>
	
</div>

<table id="table" class="table table-hover table-mc-light-blue">
                <thead>
                <tr>
                    <!--<td>ID </td>-->
                    <td>Nama Course</td> 
                    <td>Registration Course</td> 
                    <td>Operational Course</td> 
					
                    <td colspan="2">Action</td>
                </tr>
                </thead>
                <tbody>
				<?php $i = 0; ?>
				<?php foreach ($subjectCourseDTOs as $row) :?>
                <tr>
                <td data-title="Nama Course"> <?php echo $row->name(); ?> </td>
                <td data-title="Registration Course"> <?php echo $row->startRegistrationDate(); ?> - <?php echo $row->endRegistrationDate(); ?></td>
                <td data-title="Operational Course"> <?php echo $row->startOperationalDate(); ?> - <?php echo $row->endOperationalDate(); ?></td>
                        <td data-title="Action">
                            <!--{{ link_to("city/edit", "Edit", "class": "btn") }}-->
							<a href='<?php echo $this->url->get('subjectcourse/edit/'.$row->id().'/'.$row->viewSubjectDTO()->id());?>' class="btn">Edit</a>
                        </td>
                        <td>
                        	<a href='<?php echo $this->url->get('subjectcourse/remove/'.$row->id().'/'.$row->viewSubjectDTO()->id());?>' class="btn">Remove</a>
                        </td>
                    </tr>
					<?php $i++; ?>
                <?php endforeach?>
                   </tbody>
</table>