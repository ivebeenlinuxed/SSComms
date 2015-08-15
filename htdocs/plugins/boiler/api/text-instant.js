$(document).ready(function() {
	TextWidgetFactory.Render($("body"));
	$("body").on("DOMSubtreeModified", function() {
		TextWidgetFactory.Render($("body"));
	});
});

TextWidgetFactory = new Object();
TextWidgetFactory.rendering = false;
TextWidgetFactory.Render = function(el) {
	if (TextWidgetFactory.rendering) {
		return;
	}
	TextWidgetFactory.rendering = true;
	$("[type='text'][data-table][data-id][data-field]", el).each(function() {
		if (!this.widget) {
			new TextWidget(this);
		}
	});	
	TextWidgetFactory.rendering = false;
}

TextWidget = function(el) {
	this.element = $(el);
	this.element.get(0).widget = this;
	this.table = this.element.attr("data-table");
	this.id = this.element.attr("data-id");
	this.field = this.element.attr("data-field");
	
	this.getResult = function() {
		return $(this.element).attr("data-result")? $(this.element).attr("data-result") : $(this.element).val();
	}
	
	this.keyUpTimeout = null;

	this.keyup = function() {
		if (this.keyUpTimeout != null) {
			clearTimeout(this.keyUpTimeout);
		}
		p = $(this.element).parent();
		if (p.is(".form-group")) {
			p.removeClass("has-success").removeClass("has-error").addClass("has-warning");
		}
		this.keyUpTimeout = setTimeout(this._doKeyUp.bind(this), 2000);
	}

	this._doKeyUp = function() {
		this.keyUpTimeout = null;
		$.ajax({
			url: "/api/"+this.table+"/"+this.id+".json",
			type: "put",
			data: encodeURIComponent(this.field)+"="+encodeURIComponent(this.getResult()),
			dataType: "json",
			success: function(data) {
				p = $(this.element).parent();
				if (p.is(".form-group")) {
					if (data == null) {
						p.removeClass("has-warning").addClass("has-error");
					} else {
						p.removeClass("has-warning").addClass("has-success");
					}
				}
			},
			error: function() {
				p = $(this.element).parent();
				if (p.is(".form-group")) {
					p.removeClass("has-warning").addClass("has-error");
				}
			},
			context: this
		});
	};
	$(this.element).on("keyup", this.keyup.bind(this));
}

$(document).ready(function() {
	SelectWidgetFactory.Render($("body"));
	$("body").on("DOMSubtreeModified", function() {
		SelectWidgetFactory.Render($("body"));
	});
});

SelectWidgetFactory = new Object();
SelectWidgetFactory.rendering = false;
SelectWidgetFactory.Render = function(el) {
	if (SelectWidgetFactory.rendering) {
		return;
	}
	SelectWidgetFactory.rendering = true;
	$("select[data-table][data-id][data-field]", el).each(function() {
		if (!this.widget) {
			new SelectWidget(this);
		}
	});	
	SelectWidgetFactory.rendering = false;
}

SelectWidget = function(el) {
	this.element = $(el);
	this.element.get(0).widget = this;
	this.table = this.element.attr("data-table");
	this.id = this.element.attr("data-id");
	this.field = this.element.attr("data-field");
	
	this.getResult = function() {
		return $(this.element).attr("data-result")? $(this.element).attr("data-result") : $(this.element).val();
	}
	
	this.change = function() {
		p = $(this.element).parent();
		if (p.is(".form-group")) {
			p.removeClass("has-success").removeClass("has-error").addClass("has-warning");
		}
		$.ajax({
			url: "/api/"+this.table+"/"+this.id+".json",
			type: "put",
			data: encodeURIComponent(this.field)+"="+encodeURIComponent(this.getResult()),
			dataType: "json",
			success: function(data) {
				p = $(this.element).parent();
				if (p.is(".form-group")) {
					if (data == null) {
						p.removeClass("has-warning").addClass("has-error");
					} else {
						p.removeClass("has-warning").addClass("has-success");
					}
				}
			},
			error: function() {
				p = $(this.element).parent();
				if (p.is(".form-group")) {
					p.removeClass("has-warning").addClass("has-error");
				}
			},
			context: this
		});
	};
	$(this.element).on("change", this.change.bind(this));
}



$(document).ready(function() {
	CheckboxWidgetFactory.Render($("body"));
	$("body").on("DOMSubtreeModified", function() {
		CheckboxWidgetFactory.Render($("body"));
	});
});

CheckboxWidgetFactory = new Object();
CheckboxWidgetFactory.rendering = false;
CheckboxWidgetFactory.Render = function(el) {
	if (CheckboxWidgetFactory.rendering) {
		return;
	}
	CheckboxWidgetFactory.rendering = true;
	$("input[type='checkbox'][data-table][data-id][data-field]", el).each(function() {
		if (!this.widget) {
			new CheckboxWidget(this);
		}
	});	
	CheckboxWidgetFactory.rendering = false;
}

CheckboxWidget = function(el) {
	this.element = $(el);
	this.element.get(0).widget = this;
	this.table = this.element.attr("data-table");
	this.id = this.element.attr("data-id");
	this.field = this.element.attr("data-field");
	
	this.getResult = function() {
		if (this.element[0].checked) {
			return this.element.attr("data-activated");
		} else {
			return this.element.attr("data-deactivated");
		}
	}
	
	this.change = function() {
		p = $(this.element).parent();
		if (p.is(".form-group")) {
			p.removeClass("has-success").removeClass("has-error").addClass("has-warning");
		}
		$.ajax({
			url: "/api/"+this.table+"/"+this.id+".json",
			type: "put",
			data: encodeURIComponent(this.field)+"="+encodeURIComponent(this.getResult()),
			dataType: "json",
			success: function(data) {
				p = $(this.element).parent();
				if (p.is(".form-group")) {
					if (data == null) {
						p.removeClass("has-warning").addClass("has-error");
					} else {
						p.removeClass("has-warning").addClass("has-success");
					}
				}
			},
			error: function() {
				p = $(this.element).parent();
				if (p.is(".form-group")) {
					p.removeClass("has-warning").addClass("has-error");
				}
			},
			context: this
		});
	};
	$(this.element).on("change", this.change.bind(this));
}
