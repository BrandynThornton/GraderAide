<form id="newstudentform" action="/GraderAide/Student/newstudent" method="post" role="form">
    <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="John">
    </div>
    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Doe">
    </div>
    <div class="form-group">
        <label for="DOB">Date Of Birth</label>
        <div class="input-append date" id="dp3" data-date="" data-date-format="dd-mm-yyyy">
            <input id="DOB" name="DOB" class="span2" size="16" type="text" value="">
            <span class="add-on"><i class="icon-th"></i></span>
        </div>
    </div>
    <div class="form-group">
        <label for="grade">Grade</label>
        <select name="grade" id="grade" class="form-control">
            <option>K</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
          </select>
    </div>
    <label class="radio-inline">
        <input type="radio" id="male" name="male" value="1"> Male
    </label>
    <label class="radio-inline">
        <input type="radio" id="female" name="male" value="0"> Female
    </label>
    
    <button type="submit" class="btn btn-default">Submit</button>
</form>