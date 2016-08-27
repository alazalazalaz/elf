<style>

li {list-style-type:none;}
.exception{ font-family: Microsoft YaHei;}
.title table{width: 70%;font-size: x-large;margin: auto;text-align: left;WORD-WRAP: break-word;table-layout: fixed;color:red;padding-bottom:45px;}
.ex-table{margin: auto;table-layout: fixed;width: 70%; color:royalblue; word-break:break-all;}
.ex-table thead th{padding-right: 30px;text-align: left;}
.ex-table tr{line-height: 30px;}
</style>

<div>
	<div class="exception">
		<div class="title">
			<table>
				<thead>
					<tr>
						<td><?php echo $type;?></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $msg;?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div>
			<table class='ex-table' rules=rows frame="above">
				<thead>
					<tr>
						<th width='20'></th>
						<th width="50%">Trace:</th>
						<th width='80'></th>
						<th width='50'></th>
					</tr>
					<tr>
						<th width='20'>No</th>
						<th width="50%">file</th>
						<th width='80'>function</th>
						<th width='50'>line</th>
					</tr>
				</thead>
				<tbody>
					<tr style="color:red">
						<td></td>
						<td><?php echo $file;?></td>
						<td></td>
						<td><?php echo $line?></td>
					</tr>
					<?php
					$i=count($traceList);
					foreach($traceList as $key => $v){
						echo "
						<tr>
							<td>".$i--."</td>
							<td>".$v['file']."</td>
							<td>".$v['function']."</td>
							<td>".$v['line']."</td>
						</tr>
						";
					}
					?>
					
				</tbody>
			</table>
		</div>
	</div>
</div>