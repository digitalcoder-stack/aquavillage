<style>
/* The check-container */
.check-container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  font-weight: unset;
  box-shadow: 1px 2px 1px 0px #d7d0d0;
  border-top: 1px solid #f2f9ff;
}

/* Hide the browser's default checkbox */
.check-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.check-container:hover input ~ .checkmark {
  background-color: #ccc;
}

.check-container:hover input:checked  ~ .checkmark {
  background-color: #df02ba;
}

/* When the checkbox is checked, add a blue background */
.check-container input:checked ~ .checkmark {
  border: 1px solid #fcf50f;
  background-color: #ff00d4;
  box-shadow: 1px 1px 2px 1px #b4b2b2;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.check-container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.check-container .checkmark:after {
  left: 8px;
  top: 2px;
  width: 9px;
  height: 15px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
#UserRol h4{
  line-height: unset;
}

.toggle-child {
  text-align: center;
  float: right;
  margin-top: -37px;
  margin-right: 0px;
  width: 20px;
  box-shadow: 1px 2px 1px 0px #d7d0d0;
  border-top: 1px solid #f2f9ff;
}
</style>