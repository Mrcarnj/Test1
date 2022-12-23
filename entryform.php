<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('navbar.php'); ?>
    <link rel="stylesheet" type="text/css" href="formstyle2.css">
    <script src="/Users/mikedietrich/repos/Test1/form-validation.js"></script>
</head>
<body>
   <!-- multistep form -->
<form id="msform">
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Entry Setup</li>
    <li>Social Profiles</li>
    <li>Personal Details</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Entry Information</h2>
    <h3 class="fs-subtitle">All Fields are Required *</h3>
    <input type="text" name="name" placeholder="Name" required/>
    <input type="email" name="email" placeholder="Email" required/>
    <input type="text" name="entry" placeholder="Entry Name" required/>
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Pick Golfers</h2>
    <h3 class="fs-subtitle">Select a total of 8 golfers</h3>
    <select id="golfer_1" name="pick_1">
    <option value="Option 1">Option 1</option>
    <option value="Option 2">Option 2</option>
    <option value="Option 3">Option 3</option>
    </select>
    <input type="text" name="facebook" placeholder="Facebook" />
    <input type="text" name="gplus" placeholder="Google Plus" />
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Personal Details</h2>
    <h3 class="fs-subtitle">We will never sell it</h3>
    <input type="text" name="fname" placeholder="First Name" />
    <input type="text" name="lname" placeholder="Last Name" />
    <input type="text" name="phone" placeholder="Phone" />
    <textarea name="address" placeholder="Address"></textarea>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="submit" name="submit" class="submit action-button" value="Submit" />
  </fieldset>
</form>
<!-- /.MultiStep Form -->
</body>
</html>