<style>
.bgc {
    background-color: purple;
}

.borderstyle {
    border-style: solid;
    border-width: 5px;
    border-color: purple;
}
</style>

<?php require 'script.php' ?>

<nav class="navbar navbar-light bgc">
    <div class="container-fluid">
        <a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
        <a class="navbar-brand text-white" href="#">
            SUPPILES
        </a>
        <a style="display:none;"  type="button" name="add" id="add" class="btn rounded-pill"><img src="../images/add-user.png"
                width="80px"><p class="text-white">เพิ่มซัพพลายเซน</p></a>
    </div>
</nav>

<div class="container box">
    <div class="table-responsive">
        <br />
        <div id="alert_message"></div>
        <table id="user_data" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ชื่อ นามสกุล</th>
                    <th scope="col">บริษัท</th>
                    <th scope="col">เบอร์โทรศัพท์</th>
                    <th scope="col">อีเมล์</th>
                    <th scope="col">ข้อมูล</th>
                    <th scope="col">เมนู</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript" language="javascript" src="insert.js"></script>