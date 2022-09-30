<ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Patient Details</a></li>
    <li><a href="#tab2" data-toggle="tab">Education Details</a></li>
    <li><a href="#tab3" data-toggle="tab">Medical Details</a></li>
    <li><a href="#tab4" data-toggle="tab">Parents Details</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="tab1">

    <div class="form-group">
         <label>Patient Name</label>
         <input type="text" name="patient_name" id="patient_name" class="form-control" required/>

        </div>
        <div class="form-group">
         <label>Age</label>
         <input type="text" name="age" id="age" class="form-control" required />

        </div>
        <div class="form-group">
         <label>Address</label>
         <textarea class="form-control" id="address" name="address" rows="3"></textarea>

        </div>
        <div class="form-group">
         <label>Phone number</label>
         <input type="text" name="phone" id="phone" class="form-control" required/>

        </div>
        <div class="form-group">
         <label>Gender</label>
         <label class="radio-inline">
          <input type="radio" name="gender" value="male" checked> Male
         </label>
         <label class="radio-inline">
          <input type="radio" name="gender" value="female"> Female
         </label>
        </div>
        <a class="btn btn-primary btnNext" >Next</a>
    </div>
    <div class="tab-pane" id="tab2">

    <div class="form-group">
         <label>Qualification</label>
         <input type="text" name="qualification" id="qualification" class="form-control" required />

        </div>
        <div class="form-group">
         <label>University</label>
         <input type="text" name="university" id="university" class="form-control" required />

        </div>
        <a class="btn btn-primary btnNext" >Next</a>
        <a class="btn btn-primary btnPrevious" >Previous</a>
    </div>
    <div class="tab-pane" id="tab3">

    <div class="form-group">
         <label>Blood group</label>
         <input type="text" name="blood_group" id="blood_group" class="form-control" required />
         </div>
        <div class="form-group">
         <label>Height</label>
         <input type="text" name="height" id="height" class="form-control" required />

        </div>
        <div class="form-group">
         <label>Weight</label>
         <input type="text" name="weight" id="weight" class="form-control" required/>

        </div>
    <a class="btn btn-primary btnNext" >Next</a>
        <a class="btn btn-primary btnPrevious" >Previous</a>
    </div>
    <div class="tab-pane" id="tab4">

    <div class="form-group">
         <label>Father Name</label>
         <input type="text" name="father_name" id="father_name" class="form-control" required />

        </div>
        <div class="form-group">
         <label>Mother Name</label>
         <input type="text" name="mother_name" id="mother_name" class="form-control" required/>

        </div>
        <a class="btn btn-primary btnPrevious" >Previous</a>
    </div>
</div>



<script>
  $('.btnNext').click(function(){
  $('.nav-tabs > .active').next('li').find('a').trigger('click');
});

  $('.btnPrevious').click(function(){
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});
</script>