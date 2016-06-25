<div id="check_alert"></div>
<div id="check_form">
	<h1>Venue Check for <span class="venue-name">{venue name}</span></h1>
	<dl>
		<dt>Checked Out</dt>
		<dd>{checkout date}</dd>
		<dt>Expiry Date</dt>
		<dd>{expiry date}</dd>
	</dl>
	<div id="response_container"></div>
	<div class="alert alert-info">
		<strong>Have you finished?</strong>
		You must answer all questions and fill in each log before you can submit this check
	</div>
	<button class="btn btn-success pull-right" id="check_form_send" disabled>Send</button>
</div>
<template id="response_templ">
<div class="panel panel-default">
  <div class="panel-heading">{question_text}</div>
  <div class="panel-body">
	<label><input type="radio" class="venue" name="response_{response_no}" value="1" />YES</label>
	&nbsp;&nbsp;
	<label><input type="radio" name="response_{response_no}" value="0" />NO</label>
	<div class="well hidden" id="response_{response_no}_logger">
		<label>Raise a log</label>
		<textarea class="form-control"></textarea>
		<label><input type="checkbox" checked /> Requires Action</label>
	</div>
  </div>
</div>
</template>
<script type="text/javascript">
var check_data = null;
var check_id = window.location.pathname.split("/")[3];
var storage = JSON.parse(localStorage['venue_checks']);
for (var i=0; i<storage.length; i++) {
	if (storage[i].check.id == check_id) {
		check_data = storage[i];
		break;
	}
}
$(document).ready(function() {
	completed_storage = JSON.parse(localStorage['venue_checks_completed']);
	
	for (var j=0; j<completed_storage.length; j++) {
		if (completed_storage[j].check_id == check_id) {
			$("#check_form").addClass("hidden");
			$("#check_alert").addClass("alert").addClass("alert-info");
			$("#check_alert").html("<strong>Waiting for signal</strong> We're waiting for this check to be synced");
			return;
		}
	}
	
	if (check_data == null) {
		$("#check_form").addClass("hidden");
		$("#check_alert").addClass("alert").addClass("alert-danger");
		$("#check_alert").html("<strong>Sorry!</strong> This check has not been synced, or is not completed");
		return;
	}
	
	$(".venue-name").html(check_data.venue.name);
	$(".checkout-time").html(check_data.check.checkout_time);
	$(".expiry-time").html(check_data.check.expiry_time);
	
	for (var i=0; i<check_data.responses.length; i++) {
		response = check_data.responses[i];
		response_clone = document.importNode($("#response_templ").get(0).content, true);
		var question=null;
		for (var j=0; j<check_data.questions.length; j++) {
			if (check_data.questions[j].id == response.venue_check_question) {
				question = check_data.questions[j];
				break;
			}
		}
		response_clone.querySelectorAll(".panel-heading")[0].innerHTML = question.question;
		radios = response_clone.querySelectorAll("input[type='radio']");
		for (var j=0; j<radios.length; j++) {
			radios[j].name = "response_"+response.id;
			if (radios[j].value == "1") {
				radios[j].addEventListener("change", function(response) {
					return function() {
						if (this.checked) {
							logdiv = document.querySelector("#response_"+response.id+"_logger");
							if (!logdiv.classList.contains("hidden")) {
								logdiv.classList.add("hidden");
							}
						}
					}
				}(response));
			} else {
				radios[j].addEventListener("change", function(response) {
					return function() {
						if (this.checked) {
							logdiv = document.querySelector("#response_"+response.id+"_logger");
							if (logdiv.classList.contains("hidden")) {
								logdiv.classList.remove("hidden");
							}
						}
					}
				}(response));
			}
			radios[j].addEventListener("change", function() {
				try_submit_unlock();
			});
		}
		
		textareas = response_clone.querySelectorAll("textarea");
		for (var j=0; j<textareas.length; j++) {
			textareas[j].addEventListener("keyup", function() {
				try_submit_unlock();
			});
		}
		
		response_clone.querySelectorAll("input[type='radio']")[0].innerHTML = question.question;
		response_clone.querySelector(".well").id = "response_"+response.id+"_logger";
		response_clone.querySelector("textarea").name = "response_"+response.id+"_log";
		response_clone.querySelector("input[type='checkbox']").name = "response_"+response.id+"_action";
		$("#response_container").append(response_clone);
	}
});

function try_submit_unlock() {
	btn = document.querySelector("#check_form_send");
	if (can_submit_check()) {
		btn.disabled = false;
		btn.addEventListener("click", do_submit);
	} else {
		btn.disabled = true;
		try {
			btn.removeEventListener('click', do_submit);
		} catch (e) {}
	}
}

function can_submit_check() {
	if (check_data == null) {
		return true;
	}
	for (var i=0; i<check_data.responses.length; i++) {
		if ((el = document.querySelector("input[name='response_"+check_data.responses[i].id+"']:checked")) == null) {
			return false;
		} else if (el.value == 0 && document.querySelector("textarea[name='response_"+check_data.responses[i].id+"_log']").value == "") {
			return false;
		}
	}
	return true;
}

function do_submit() {
	data = new Object();
	data.responses = new Object();
	data.logs = new Array();
	data.check_id = check_id;
	for (var i=0; i<check_data.responses.length; i++) {
		el = document.querySelector("input[name='response_"+check_data.responses[i].id+"']:checked");
		data.responses[el.name] = el.value;
		if (el.value == 0) {
			log = new Object();
			log.text = document.querySelector("textarea[name='response_"+check_data.responses[i].id+"_log']").value;
			log.action = document.querySelector("input[name='response_"+check_data.responses[i].id+"_action']").checked;
			log.response = check_data.responses[i].id;
			data.logs.push(log);
			
		}
	}
	
	form = document.querySelector("#check_form");
	form.classList.add("hidden");
	
	alert = document.querySelector("#check_alert");
	alert.classList.add("alert");
	alert.classList.add("alert-success");
	alert.innerHTML = "<strong>That's all folks!</strong> Your venue check has been queued for submission, make sure you are online and check the sync status for details";
	document.querySelector("#check_alert")
	if (typeof localStorage['venue_checks_completed'] == "undefined") {
		vcc = new Array();
	} else {
		vcc = JSON.parse(localStorage['venue_checks_completed']);
	}
	vcc.push(data);
	localStorage['venue_checks_completed'] = JSON.stringify(vcc);
	for (var i=0; i<storage.length; i++) {
		if (storage[i].check.id == check_id) {
			storage.splice(i, 1);
			localStorage['venue_checks'] = JSON.stringify(storage);
		}
	}
}
</script>
