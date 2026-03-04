<style type="text/css">
@keyframes click-wave {
  0% {
    height: 30px;
    width: 30px;
    opacity: 0.35;
  }
  100% {
    height: 200px;
    width: 200px;
    margin-left: -80px;
    margin-top: -130px;
    opacity: 0;
  }
}

.option-input {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  -o-appearance: none;
  appearance: none;
  height: 30px;
  width: 30px;
  transition: all 0.15s ease-out 0s;
  background: #cbd1d8;
  border: none;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  outline: none;
  text-align: center;
}
.option-input:hover {
  background: #9faab7;
}
.option-input:checked {
  background: #40e0d0;
}
.option-input:checked::before {
  content: '✔';
  display: inline-block;
  font-size: 20.66667px;
  text-align: center;
}
.option-input:checked::after {
  -webkit-animation: click-wave 0.65s;
  -moz-animation: click-wave 0.65s;
  animation: click-wave 0.65s;
  background: #40e0d0;
  content: '';
  display: block;
}
</style>