"use strict";
var redips = {};
redips.init = function () {
	var	rd = REDIPS.drag;
	rd.init();
	rd.dropMode = 'single';			// dragged elements can be placed only to the empty cells
	rd.hover.colorTd = '#9BB3DA';	// set hover color
	rd.clone.keyDiv = true;			// enable cloning DIV elements with pressed SHIFT key
	redips.divNodeList = document.getElementById('table2').getElementsByTagName('div');
	redips.reportButton();
	// element is dropped
	rd.event.dropped = function () {
		var	objOld = rd.objOld,					// original object
			targetCell = rd.td.target,			// target cell
			targetRow = targetCell.parentNode,	// target row
			i, objNew;							// local variables
		if (document.getElementById('week').checked === true && objOld.className.indexOf('redips-clone') > -1) {
			for (i = 0; i < targetRow.cells.length; i++) {
				if (targetRow.cells[i].childNodes.length > 0) {
					continue;
				}
				objNew = rd.cloneObject(objOld);
				targetRow.cells[i].appendChild(objNew);
			}
		}
		if (rd.td.target !== rd.td.source) { 
			redips.printMessage(redipsMsg);
		}
		redips.reportButton();
	};
	rd.event.deleted = function () {
		redips.printMessage(redipsMsgd);
		redips.reportButton();
	};
	rd.event.clicked = function () {
		redips.showAll();
	};
};

redips.save = function () 
{
	var class_id = cl_id;
	var section_id = sc_id;
	var content = REDIPS.drag.saveContent('table2');
	// and save content
	window.location.href = redipsURL+'admin/class_routine/save?' + content+'&class_id='+class_id+'&section_id='+section_id;
};

redips.report = function (subject) {
		// define day and time labels
	var day = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
		time = ['08:00', '09:00', '10:00', '11:00', '12:00',
		        '13:00', '14:00', '15:00', '16:00'],
		div = [],	// define array
		cellIndex,	// cell index
		rowIndex,	// row index
		id,			// element id
		i,			// loop variable
		num = 0,	// number of found subject
		str = '';	// result string
	redips.showAll();
	for (i = 0; i < redips.divNodeList.length; i++) {
		div[i] = redips.divNodeList[i];
	}
	div.sort(function (a, b) {
		var a_ci = a.parentNode.cellIndex,				// a element cell index
			a_ri = a.parentNode.parentNode.rowIndex,	// a element row index
			b_ci = b.parentNode.cellIndex,				// b element cell index
			b_ri = b.parentNode.parentNode.rowIndex;	// b element row index
		return a_ci * 100 + a_ri - (b_ci * 100 + b_ri);
	});
	for (i = 0; i < div.length; i++) {
		id = div[i].id.substr(0, 2);
		if (id === subject) { 
			cellIndex = div[i].parentNode.cellIndex;
			rowIndex = div[i].parentNode.parentNode.rowIndex;
			str += day[cellIndex - 1] + '\t\t' + time[rowIndex - 1] + '\n';
			num++;
		}
		else {
			div[i].style.visibility = 'hidden';
		}
	}
	if (document.getElementById('report').checked === true) {
		setTimeout(function () {
			alert('Number of found subjects: ' + num + '\n' + str);
		}, 200);
	}
};
redips.reportButton = function () {
	var	id,			// element id
		i,			// loop variable
		count,		// number of subjects in timetable
		style
};
redips.printMessage = function (message) {
	document.getElementById('message').innerHTML = message;
};
redips.showAll = function () {
	var	i; // loop variable
	for (i = 0; i < redips.divNodeList.length; i++) {
		redips.divNodeList[i].style.visibility = 'visible';
	}
};
if (window.addEventListener) {
	window.addEventListener('load', redips.init, false);
}
else if (window.attachEvent) {
	window.attachEvent('onload', redips.init);
}