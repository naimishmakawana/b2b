
$('#b2b_customer').validate({
      rules: {
        NameOfOrganization: {
          required: true,
        },
        AddressFirstLine: {
          required: true,
        },
        City: {
          required: true,
        },
        State: {
          required: true,
        },
        Country: {
          required: true,
        },
        PostalCode: {
          required: true,
	  maxlength: 10
        },
        ContactPersonFirstName: {
          required: true,
        },
        ContactPersonEmailAddress: {
          required: true,
        },
        ContactPersonDesignation: {
          required: true,
        }
    },

    errorPlacement: function(error, element) {
        $(element).parent('div').addClass('has-error');
     }
});



$().ready(function() {

    /*$.validator.addMethod("checkManufacturerName", 
        function(value, element) {
            var result = false;
            $.ajax({
                type:"POST",
                async: false,
		 headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "/checkManufacturerName", // script to validate in server side
                data: {ManufacturerName: value},
                success: function(data) { alert(data); 
                    result = (data == true) ? true : false;
                }
            });
            // return true if username is exist in database
            return result; 
        }, 
        "This username is already taken! Try another."
    ); */

    // validate signup form on keyup and submit
	    $('#tag_manufacturer').validate({
	      rules: {
		ManufacturerName: {
		  required: true
		},
		AddressFirstLine: {
		  required: true,
		},
		City: {
		  required: true,
		},
		State: {
		  required: true,
		},
		Country: {
		  required: true,
		},
		PostalCode: {
		  required: true,
		  maxlength: 10
		},
		ContactPersonFirstName: {
		  required: true,
		},
		ContactPersonEmailAddress: {
		  required: true,
		},
		ContactPersonDesignation: {
		  required: true,
		},
		ContactPersonTelNumber: {
		  required: true,
		}
	    },

	    errorPlacement: function(error, element) {
		$(element).parent('div').addClass('has-error');
	     }
	});
});

$('#b2bcustomer_product').validate({
      rules: {
        ProductName: {
          required: true,
        }
    },

    errorPlacement: function(error, element) {
        $(element).parent('div').addClass('has-error');
     }
});

$('#solution_feature').validate({
      rules: {
        SolutionFeatureName: {
          required: true,
        }
    },

    errorPlacement: function(error, element) {
        $(element).parent('div').addClass('has-error');
     }
});

$('#b2b_customer_category').validate({
      rules: {
        CategoryName: {
          required: true,
        }
    },

    errorPlacement: function(error, element) {
        $(element).parent('div').addClass('has-error');
     }
});

$('#b2b_customer_campaign').validate({
      rules: {
        CampaignName: {
          required: true,
        },
        CampaignObjective: {
          required: true,
        },
        CampaignStartDate: {
          required: true,
        },
        CampaignEndDate: {
          required: true,
        },
        RedirectURL: {
          required: true,
        },
        EndDateRedirectURL: {
          required: true,
        },
        'TapRedirectURL[]': {
          required: true,
        }
    },

    errorPlacement: function(error, element) {
        $(element).parent('div').addClass('has-error');
     }
});

$('#nfc_tagbundle').validate({
      rules: {
        TagBundleName: {
          required: true,
        }
    },

    errorPlacement: function(error, element) {
        $(element).parent('div').addClass('has-error');
     }
});

$('#qr_code').validate({
      rules: {
        B2BCustomerId: {
          required: true,
        },
        QRCodeFileName: {
          required: true,
        },
        QRCodeImage: {
          required: true,
        },
        QRCodeGeneratorName: {
          required: true,
        }
    },

    errorPlacement: function(error, element) {
        $(element).parent('div').addClass('has-error');
     }
});


$('#tag_roll_form').validate({
      rules: {
        NFCTagId: {
          required: true,
        },
        B2BCustomerId: {
          required: true,
        },
        NumberOfTags: {
          required: true,
        },
        ManufacturerName: {
          required: true,
        },
        RollNo: {
          required: true,
        },
        StartingSequenceNo: {
          required: true,
        },
        EndingSequenceNo: {
          required: true,
        }
    },

    errorPlacement: function(error, element) {
        $(element).parent('div').addClass('has-error');
     }
});

$('#datatables').DataTable({"aaSorting": []});

$("#NumberOfTags").keypress(function (e) {
   
   if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      return false;
  }
});


