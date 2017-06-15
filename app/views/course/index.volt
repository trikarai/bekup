{{ content() }}

<h1>Subject</h1>

<div align="right">
	<a href='<?php echo $this->url->get('course/new');?>' class="btn btn-primary">Add Course</a>
</div>

<table id="table" class="table table-hover table-mc-light-blue">
                <thead>
                <tr>
                    <!--<td>ID </td>-->
                    <td>Subject</td> 
                    <td colspan="2">Action</td>
                </tr>
                </thead>
                <tbody>
				<?php $i = 0; ?>
				<?php foreach ($courseDTOs as $row) :?>
                <tr>
                <td data-title="Subject"> 
                	<a href='<?php echo $this->url->get('courseclass/index/'.$row->id()); ?>'>
						<?php echo $row->name(); ?> 
                    </a>
                </td>
                        <td data-title="Action">
                            <!--{{ link_to("city/edit", "Edit", "class": "btn") }}-->
							<a href='<?php echo $this->url->get('course/edit/'.$row->id());?>' class="btn">Edit</a>
                        </td>
                        <td>
                        	<a href='<?php echo $this->url->get('course/remove/'.$row->id());?>' class="btn">Remove</a>
                        </td>
                    </tr>
					<?php $i++; ?>
                <?php endforeach?>
                   </tbody>
</table>