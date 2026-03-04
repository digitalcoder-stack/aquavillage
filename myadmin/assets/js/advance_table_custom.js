/*=========================================================================================
[Advance Table Custom Javascript]

Project	     : myaddsworld
Author       : Logixhunt
Author URL   : https://www.myaddsworld.in/
Version      : 1.0
Primary use  : myaddsworld

Only Use For advance-table.html Page.

==========================================================================================*/


(function ($) {
	"use strict";

	jQuery(document).ready(function ($) {


		/* 
		=================================================================
		Datatables Example One JS
		=================================================================	
		*/
		$('#datatables_example_1').DataTable({
			'order': [
				[0, "asc"]
			],
			'paging': true,
			'pagingType': "numbers",
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});

		/* 
		=================================================================
		Responsiv Datatables Example JS
		=================================================================	
		*/

		$('#responsive_datatables_example').DataTable({
			'paging': true,
			'pagingType': "numbers",
			'responsive': true,
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});

		var table = $('#button_datatables_example').DataTable({

			'pagingType': "numbers",
			'lengthChange': false,
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});

		new $.fn.dataTable.Buttons(table, {
			buttons: [{
					extend: "copy",
					className: "datatable-btn btn-sm"
				},
				{
					extend: "csv",
					className: "datatable-btn btn-sm"
				},
				{
					extend: "pdf",
					className: "datatable-btn btn-sm"
				},
				{
					extend: "print",
					className: "datatable-btn btn-sm"
				}
			]
		});

		table.buttons().container()
			.appendTo($('.col-sm-6:eq(0)', table.table().container()));


	});


}(jQuery));