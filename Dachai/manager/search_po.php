
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
		<h2>
			Result(s) . . . . .
		</h2>
			<form method="post" action="search.php"  class="form-inline">
			  <div class="form-group">
				<label for="Date_From">Date From</label>
				<input type="date" name="date_from" value="<?php echo (isset ($_POST['date_from'])) ? $_POST['date_from']: ''; ?>" class="form-control" />
			  </div>
			  <button type="submit" name="search" class="btn btn-primary">Search</button>
			</form>
			
			<br />
			  <a href="index.php" style="text-decoration:none;">
			  <button type="submit" class="btn btn-warning">Back</button>
			  </a>
			<br />
			<br />
			
			<div class="table-responsive">
				<table class="table">
					<tr>
          <th>Member Name</th>
						<th>Date Added</th>
					</tr>
				<?php
					$sql = ("SELECT * FROM po  where (po.po_Create BETWEEN '".$_POST['date_from']." 00:00:01' and '".$_POST['date_from']." 23:59:59') order by po_id DESC");
					$result = mysqli_query($con , $sql);
					for ($count=0; $row_member = mysqli_fetch_array($result); $count++){
					$id = $row_member['tbl_member_id'];
				?>
					<tr>
						<td><?php echo $row_member['po_id']; ?></td>
						<td><?php echo date("M d, Y h:i:s A", strtotime ($row_member['po_Create'])); ?></td>
					</tr>
					<?php	}	?>
				</table>
			</div>
      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Copyright &copy; 2016, <a href="http://www.sourcecodester.com/">Free source code, tutorials and articles</a> </p>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="search/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
