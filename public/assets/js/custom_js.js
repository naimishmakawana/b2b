
function OnDeleteCustomer(CustomerId)
{
	if (confirm("Are you sure you want to delete?") == true) {
	    var table = $('#datatables').DataTable();
	  	
		table.row("#row_"+CustomerId).remove().draw( false );

		var request = $.ajax({
		  url: "DeleteCustomer",
		  method: "GET",
		  data: { CustomerId : CustomerId },
		  dataType: "html"
		});
		 
		request.done(function( msg ) { 
		   //alert(msg);
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  //alert( "Request failed: " + textStatus );
		});

	} 
	
} 

$('input[name=B2BCustomerStatus]').on("click",function(){

    var CustomerId = $(this).attr('id');

    if(this.checked) {
        var status = 1;
    } else {
        var status = 0;
    }

    $.ajax({
       method: "GET",
       url: 'ChangeStatusToCustomer',
       dataType: 'json',
       data: {CustomerId:CustomerId, ActiveStatus:status},

       success: function (data) {
             // alert('success');            
       },
       error: function (data) {
             //alert(data);
       }
    });

 });

function OnDeleteCategory(CategoryId)
{
	if (confirm("Are you sure you want to delete?") == true) {
	    var table = $('#datatables').DataTable();
	  	
		table.row("#row_"+CategoryId).remove().draw( false );

		var request = $.ajax({
		  url: "DeleteCategory",
		  method: "GET",
		  data: { CategoryId : CategoryId },
		  dataType: "html"
		});
		 
		request.done(function( msg ) { 
		   //alert(msg);
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  //alert( "Request failed: " + textStatus );
		});

	} 
	
} 
 $('body').on('click', 'input[name=B2BCategoryStatus]', function (){

    var CategoryId = $(this).attr('id');

    if(this.checked) {
        var status = 1;
    } else {
        var status = 0;
    }

    $.ajax({
       method: "GET",
       url: 'ChangeStatusToCategory',
       dataType: 'json',
       data: {CategoryId:CategoryId, ActiveStatus:status},

       success: function (data) {
             // alert('success');            
       },
       error: function (data) {
             //alert(data);
       }
    });
});
/*$('input[name=B2BCategoryStatus]').on("click",function(){

    var CategoryId = $(this).attr('id');

    if(this.checked) {
        var status = 1;
    } else {
        var status = 0;
    }

    $.ajax({
       method: "GET",
       url: 'changestatustocategory',
       dataType: 'json',
       data: {CategoryId:CategoryId, ActiveStatus:status},

       success: function (data) {
             // alert('success');            
       },
       error: function (data) {
             //alert(data);
       }
    });

 });*/

function OnDeleteProduct(ProductId)
{
	if (confirm("Are you sure you want to delete?") == true) {
	    var table = $('#datatables2,#datatables').DataTable();
	  	
		table.row("#row_"+ProductId).remove().draw( false );

		var request = $.ajax({
		  url: "DeleteProduct",
		  method: "GET",
		  data: { ProductId : ProductId },
		  dataType: "html"
		});
		 
		request.done(function( msg ) { 
		   //alert(msg);
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  //alert( "Request failed: " + textStatus );
		});

	} 
	
} 
 
$('input[name=B2BProductStatus]').on("click",function(){

    var ProductId = $(this).attr('id');

    if(this.checked) {
        var status = 1;
    } else {
        var status = 0;
    }

    $.ajax({
       method: "GET",
       url: 'ChangeStatusToProduct',
       dataType: 'json',
       data: {ProductId:ProductId, ActiveStatus:status},

       success: function (data) {
             // alert('success');            
       },
       error: function (data) {
             //alert(data);
       }
    });

 });



function OnRemoveProductFromCategoty(CategoryProductId)
{
	
	var request = $.ajax({
	  url: "RemoveProductFromCategoty",
	  method: "GET",
	  data: { CategoryProductId : CategoryProductId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});


} 

function OnAddProductInCategoty(ProductId,CategoryId)
{
	   
	var request = $.ajax({
	  url: "AddProductInCategoty",
	  method: "GET",
	  data: { ProductId : ProductId, CategoryId : CategoryId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
} 


function ViewCategotiesByProduct(ProductId)
{  
	var request = $.ajax({
	  url: "ViewCategoriesByProduct",
	  method: "GET",
	  data: { ProductId : ProductId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 

		$('#datatables3').DataTable();

	  	$("#CatProductsModal").html(msg);

	  	$('#datatables3').DataTable();
	   
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
} 


function OnAddTagManufacturerInCustomer(TagManufacturerId,B2BCustomerId)
{
	   
	var request = $.ajax({
	  url: "AddTagManuFacturerInCustomer",
	  method: "GET",
	  data: { TagManufacturerId : TagManufacturerId, B2BCustomerId : B2BCustomerId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
} 

function OnRemoveTagManufacturerFromCustomer(CategoryTagManufacturerId)
{
	
	var request = $.ajax({
	  url: "RemoveTagManufacturerFromCustomer",
	  method: "GET",
	  data: { CategoryTagManufacturerId : CategoryTagManufacturerId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});


} 


$('input[name=TagManufacturerStatus]').on("click",function(){

    var TagManufacturerId = $(this).attr('id');

    if(this.checked) {
        var status = 1;
    } else {
        var status = 0;
    }

    $.ajax({
       method: "GET",
       url: 'ChangeStatusToTagManufacturer',
       dataType: 'json',
       data: {TagManufacturerId:TagManufacturerId, ActiveStatus:status},

       success: function (data) {
             // alert('success');            
       },
       error: function (data) {
             //alert(data);
       }
    });
});

function OnDeleteTagManufacturer(TagManufacturerId)
{
	if (confirm("Are you sure you want to delete?") == true) {
	    var table = $('#datatables2').DataTable();
	  	
		table.row("#row_"+TagManufacturerId).remove().draw( false );

		var request = $.ajax({
		  url: "DeleteTagManufacturer",
		  method: "GET",
		  data: { TagManufacturerId : TagManufacturerId },
		  dataType: "html"
		});
		 
		request.done(function( msg ) { 
		   //alert(msg);
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  //alert( "Request failed: " + textStatus );
		});

	} 
} 


function OnAddSolutionFeatureInCustomer(SolutionFeatureId,B2BCustomerId)
{
	   
	var request = $.ajax({
	  url: "AddSolutionFeaturesInCustomer",
	  method: "GET",
	  data: { SolutionFeatureId : SolutionFeatureId, B2BCustomerId : B2BCustomerId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
} 

function OnRemoveSolutionFeatureFromCustomer(CustomerSolutionFeatureId)
{
	
	var request = $.ajax({
	  url: "RemoveSolutionFeaturesFromCustomer",
	  method: "GET",
	  data: { CustomerSolutionFeatureId : CustomerSolutionFeatureId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});


} 


$('input[name=SolutionFeatureStatus]').on("click",function(){

    var SolutionFeatureId = $(this).attr('id');

    if(this.checked) {
        var status = 1;
    } else {
        var status = 0;
    }

    $.ajax({
       method: "GET",
       url: 'ChangeStatusToSolutionFeatures',
       dataType: 'json',
       data: {SolutionFeatureId:SolutionFeatureId, ActiveStatus:status},

       success: function (data) {
             // alert('success');            
       },
       error: function (data) {
             //alert(data);
       }
    });
});

function OnDeleteSolutionFeature(SolutionFeatureId)
{
	if (confirm("Are you sure you want to delete?") == true) {
	    var table = $('#datatables2').DataTable();
	  	
		table.row("#row_"+SolutionFeatureId).remove().draw( false );

		var request = $.ajax({
		  url: "DeleteSolutionFeatures",
		  method: "GET",
		  data: { SolutionFeatureId : SolutionFeatureId },
		  dataType: "html"
		});
		 
		request.done(function( msg ) { 
		   //alert(msg);
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  //alert( "Request failed: " + textStatus );
		});

	} 
} 


function OnDeleteCampaign(CampaignId)
{
	if (confirm("Are you sure you want to delete?") == true) {
	    var table = $('#datatables').DataTable();
	  	
		table.row("#row_"+CampaignId).remove().draw( false );

		var request = $.ajax({
		  url: "DeleteCampaign",
		  method: "GET",
		  data: { CampaignId : CampaignId },
		  dataType: "html"
		});
		 
		request.done(function( msg ) { 
		   //alert(msg);
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  //alert( "Request failed: " + textStatus );
		});

	} 
	
} 
 $('body').on('click', 'input[name=B2BCampaignStatus]', function (){

    var CampaignId = $(this).attr('id');

    if(this.checked) {
        var status = 1;
    } else {
        var status = 0;
    }

    $.ajax({
       method: "GET",
       url: 'ChangeStatusToCampaign',
       dataType: 'json',
       data: {CampaignId:CampaignId, ActiveStatus:status},

       success: function (data) {
             // alert('success');            
       },
       error: function (data) {
             //alert(data);
       }
    });
});

     
function OnRemoveProductFromCampaign(CampaignProductId)
{
	
	var request = $.ajax({
	  url: "RemoveProductFromCampaign",
	  method: "GET",
	  data: { CampaignProductId : CampaignProductId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});


} 

function OnAddProductInCampaign(ProductId,CampaignId)
{
	   
	var request = $.ajax({
	  url: "AddProductInCampaign",
	  method: "GET",
	  data: { ProductId : ProductId, CampaignId : CampaignId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
} 


function ViewCampaignsByProduct(ProductId)
{  
	var request = $.ajax({
	  url: "ViewCampaignsByProduct",
	  method: "GET",
	  data: { ProductId : ProductId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 

		$('#datatables3').DataTable();

	  	$("#CatProductsModal").html(msg);

	  	$('#datatables3').DataTable();
	   
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
} 

$('input[name=Level1TerritoryStatus]').on("click",function(){

    var Level1TerritoryId = $(this).attr('id');

    if(this.checked) {
        var status = 1;
    } else {
        var status = 0;
    }

    $.ajax({
       method: "GET",
       url: 'ChangeStatusToLevel1Territory',
       dataType: 'json',
       data: {Level1TerritoryId:Level1TerritoryId, ActiveStatus:status},

       success: function (data) {
             // alert('success');            
       },
       error: function (data) {
             //alert(data);
       }
    });
});

function OnDeleteLevel1Territory(Level1TerritoryId)
{
	if (confirm("Are you sure you want to delete?") == true) {
	    var table = $('#datatables,#datatables2').DataTable();
	  	
		table.row("#row_"+Level1TerritoryId).remove().draw( false );

		var request = $.ajax({
		  url: "DeleteLevel1Territory",
		  method: "GET",
		  data: { Level1TerritoryId : Level1TerritoryId },
		  dataType: "html"
		});
		 
		request.done(function( msg ) { 
		   //alert(msg);
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  //alert( "Request failed: " + textStatus );
		});

	} 
	
} 

$('input[name=Level2TerritoryStatus]').on("click",function(){

    var Level2TerritoryId = $(this).attr('id');

    if(this.checked) {
        var status = 1;
    } else {
        var status = 0;
    }

    $.ajax({
       method: "GET",
       url: 'ChangeStatusToLevel2Territory',
       dataType: 'json',
       data: {Level2TerritoryId:Level2TerritoryId, ActiveStatus:status},

       success: function (data) {
             // alert('success');            
       },
       error: function (data) {
             //alert(data);
       }
    });
});

function OnDeleteLevel2Territory(Level2TerritoryId)
{
	if (confirm("Are you sure you want to delete?") == true) {
	    var table = $('#datatables,#datatables2').DataTable();
	  	
		table.row("#row_"+Level2TerritoryId).remove().draw( false );

		var request = $.ajax({
		  url: "DeleteLevel2Territory",
		  method: "GET",
		  data: { Level2TerritoryId : Level2TerritoryId },
		  dataType: "html"
		});
		 
		request.done(function( msg ) { 
		   //alert(msg);
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  //alert( "Request failed: " + textStatus );
		});

	} 
}

function OnRemoveLevel2TerritoryFromLevel1Territory(Level1TerritoryLevel2TerritoryId)
{
	
	var request = $.ajax({
	  url: "RemoveLevel2TerritoryFromLevel1Territory",
	  method: "GET",
	  data: { Level1TerritoryLevel2TerritoryId : Level1TerritoryLevel2TerritoryId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});


} 

function OnAddLevel2TerritoryInLevel1Territory(Level2TerritoryId,Level1TerritoryId)
{
	   
	var request = $.ajax({
	  url: "AddLevel2TerritoryInLevel1Territory",
	  method: "GET",
	  data: { Level2TerritoryId : Level2TerritoryId, Level1TerritoryId : Level1TerritoryId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
} 

function OnRemoveLevel1TerritoryFromCampaign(CampaignLevel1TerritoryId)
{
	
	var request = $.ajax({
	  url: "RemoveLevel1TerritoryFromCampaign",
	  method: "GET",
	  data: { CampaignLevel1TerritoryId : CampaignLevel1TerritoryId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});


} 

function OnAddLevel1TerritoryInCampaign(Level1TerritoryId,CampaignId)
{
	   
	var request = $.ajax({
	  url: "AddLevel1TerritoryInCampaign",
	  method: "GET",
	  data: { Level1TerritoryId : Level1TerritoryId, CampaignId : CampaignId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
} 

function ViewCampaignsByLevel1Territory(Level1TerritoryId)
{  
	var request = $.ajax({
	  url: "ViewCampaignsByLevel1Territory",
	  method: "GET",
	  data: { Level1TerritoryId : Level1TerritoryId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 

	  	$("#CamTerL1Modal").html(msg);

	  	$('#datatables3').DataTable();
	   
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
} 

function SaveL1TerritoryTargetUrl(CampaignLevel1TerritoryId, TargetUrl, Level1TerritoryId)
{
	var request = $.ajax({
	  url: "SaveL1TerritoryTargetUrl",
	  method: "GET",
	  data: { CampaignLevel1TerritoryId : CampaignLevel1TerritoryId, TargetUrl : TargetUrl },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   if(TargetUrl != '')
	   {
	   		$("#2TerritoryLink"+Level1TerritoryId).hide();
	   } else {
	   		$("#2TerritoryLink"+Level1TerritoryId).show();
	   }
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
}

function OnRemoveCampaignL1TerFromCampaignL1Ter(CampaignLevel2TerritoryId)
{
	
	var request = $.ajax({
	  url: "RemoveCampaignL1TerFromCampaignL1Ter",
	  method: "GET",
	  data: { CampaignLevel2TerritoryId : CampaignLevel2TerritoryId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});


} 

function OnAddCampaignL1TerFromCampaignL1Ter(Level2TerritoryId,CampaignLevel1TerritoryId)
{
	   
	var request = $.ajax({
	  url: "AddCampaignL1TerFromCampaignL1Ter",
	  method: "GET",
	  data: { Level2TerritoryId : Level2TerritoryId, CampaignLevel1TerritoryId : CampaignLevel1TerritoryId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
} 

function ViewCampaignL1TerByCampaignL2Ter(Level2TerritoryId)
{  
	var request = $.ajax({
	  url: "ViewCampaignL1TerByCampaignL2Ter",
	  method: "GET",
	  data: { Level2TerritoryId : Level2TerritoryId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 

	  	$("#CamTerL1Modal").html(msg);

	  	$('#datatables3').DataTable();
	   
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
} 

function SetTerritory2Data(Level2TerritoryId, CampaignLevel1TerritoryId)
{
	$("#Level2TerritoryId").val(Level2TerritoryId);
	$("#CampaignLevel1TerritoryId").val(CampaignLevel1TerritoryId);
}

function SaveL2TerritoryTargetUrl(CampaignLevel2TerritoryId, TargetURL)
{
	if(TargetURL != ''){
		var request = $.ajax({
		  url: "SaveL2TerritoryTargetUrl",
		  method: "GET",
		  data: { CampaignLevel2TerritoryId : CampaignLevel2TerritoryId, TargetURL : TargetURL },
		  dataType: "html"
		});
		 
		request.done(function( msg ) { 
		  
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  //alert( "Request failed: " + textStatus );
		});
	}
}


function OnAddTagBundleInCampaign(NFCTagBundleId,CampaignId)
{
	   
	var request = $.ajax({
	  url: "AddTagBundleInCampaign",
	  method: "GET",
	  data: { NFCTagBundleId : NFCTagBundleId, CampaignId : CampaignId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
}

function OnRemoveTagBundleFromCampaign(CampaignTagBundleId)
{
	
	var request = $.ajax({
	  url: "RemoveTagBundleFromCampaign",
	  method: "GET",
	  data: { CampaignTagBundleId : CampaignTagBundleId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
} 

$('input[name=TagBundleStatus]').on("click",function(){

    var NFCTagBundleId = $(this).attr('id');

    if(this.checked) {
        var status = 1;
    } else {
        var status = 0;
    }

    $.ajax({
       method: "GET",
       url: 'ChangeStatusToTagBundle',
       dataType: 'json',
       data: {NFCTagBundleId:NFCTagBundleId, ActiveStatus:status},

       success: function (data) {
             // alert('success');            
       },
       error: function (data) {
             //alert(data);
       }
    });
});

function OnDeleteTagBundle(NFCTagBundleId)
{
	if (confirm("Are you sure you want to delete?") == true) {
	    var table = $('#datatables,#datatables2').DataTable();
	  	
		table.row("#row_"+NFCTagBundleId).remove().draw( false );

		var request = $.ajax({
		  url: "DeleteTagBundle",
		  method: "GET",
		  data: { NFCTagBundleId : NFCTagBundleId },
		  dataType: "html"
		});
		 
		request.done(function( msg ) { 
		   //alert(msg);
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  //alert( "Request failed: " + textStatus );
		});

	} 
}

function OnAddTagBundleInCampaign(TagBundleId,CampaignId)
{
	   
	var request = $.ajax({
	  url: "AddTagBundleInCampaign",
	  method: "GET",
	  data: { TagBundleId : TagBundleId, CampaignId : CampaignId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
}

function OnRemoveTagBundleFromCampaign(TagBundleId, CampaignId)
{
	
	var request = $.ajax({
	  url: "RemoveTagBundleFromCampaign",
	  method: "GET",
	  data: { TagBundleId : TagBundleId,  CampaignId : CampaignId},
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
}

function ViewTagBundleInTags(TagBundleId)
{  
	var request = $.ajax({
	  url: "ViewTagBundleInTags",
	  method: "GET",
	  data: { TagBundleId : TagBundleId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 

	  	$("#TagBundleL1Modal").html(msg);

	  	$('#datatables3').DataTable();
	   
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
} 


function OnAddTagBundleInL1Territory(TagBundleId,CampaignLevel1TerritoryId,CampaignId)
{
	   
	var request = $.ajax({
	  url: "AddTagBundleInL1Territory",
	  method: "GET",
	  data: { TagBundleId : TagBundleId, CampaignLevel1TerritoryId : CampaignLevel1TerritoryId, CampaignId:CampaignId},
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
}

function OnRemoveTagBundleFromL1Territory(TagBundleId, CampaignLevel1TerritoryId)
{
	
	var request = $.ajax({
	  url: "RemoveTagBundleFromL1Territory",
	  method: "GET",
	  data: { TagBundleId : TagBundleId,  CampaignLevel1TerritoryId : CampaignLevel1TerritoryId},
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
}

function ViewTagCampaignInTags(CampaignId)
{  
	var request = $.ajax({
	  url: "ViewTagCampaignInTags",
	  method: "GET",
	  data: { CampaignId : CampaignId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 

	  	$("#TagBundleL1Modal").html(msg);

	  	$('#datatables3').DataTable();
	   
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
}

function OnAddTagBundleInL2Territory(TagBundleId,CampaignLevel1TerritoryId,CampaignLevel2TerritoryId,CampaignId)
{
	   
	var request = $.ajax({
	  url: "AddTagBundleInL2Territory",
	  method: "GET",
	  data: { TagBundleId : TagBundleId, CampaignLevel1TerritoryId : CampaignLevel1TerritoryId, CampaignLevel2TerritoryId:CampaignLevel2TerritoryId, CampaignId:CampaignId},
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
}

function OnRemoveTagBundleFromL2Territory(TagBundleId, CampaignLevel2TerritoryId)
{
	
	var request = $.ajax({
	  url: "RemoveTagBundleFromL2Territory",
	  method: "GET",
	  data: { TagBundleId : TagBundleId,  CampaignLevel2TerritoryId : CampaignLevel2TerritoryId},
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
}

function OnAddTagInCampaign(NFCTagId, CampaignId){

	var request = $.ajax({
	  url: "AddTagInCampaign",
	  method: "GET",
	  data: { NFCTagId : NFCTagId, CampaignId : CampaignId},
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
}

function OnRemoveTagFromCampaign(NFCTagId, CampaignId)
{
	
	var request = $.ajax({
	  url: "RemoveTagFromCampaign",
	  method: "GET",
	  data: { NFCTagId : NFCTagId,  CampaignId : CampaignId},
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 
	   //alert(msg);
	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
}


function ViewCampaignInQRCodes(B2BCustomerId, CampaignId, CampaignLevel1TerritoryId=0, CampaignLevel2TerritoryId=0)
{  
	var request = $.ajax({
	  url: "ViewCampaignInQRCodes",
	  method: "GET",
	  data: { B2BCustomerId : B2BCustomerId, CampaignId : CampaignId, CampaignLevel1TerritoryId: CampaignLevel1TerritoryId, CampaignLevel2TerritoryId:CampaignLevel2TerritoryId },
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 

	  	$("#QRCodeL1Modal").html(msg);

	  	$('#datatables4').DataTable();
	   
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
}


function OnAddQRCodeInCampaign(QRCodeId, CampaignId, CampaignLevel1TerritoryId=0, CampaignLevel2TerritoryId=0){

	var request = $.ajax({
	  url: "AddQRCodeInCampaign",
	  method: "GET",
	  data: { QRCodeId : QRCodeId, CampaignId : CampaignId, CampaignLevel1TerritoryId:CampaignLevel1TerritoryId, CampaignLevel2TerritoryId:CampaignLevel2TerritoryId},
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 

	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
}

function OnRemoveQRCodeInCampaign(QRCodeId, CampaignId, CampaignLevel1TerritoryId=0, CampaignLevel2TerritoryId=0){

	var request = $.ajax({
	  url: "RemoveQRCodeInCampaign",
	  method: "GET",
	  data: { QRCodeId : QRCodeId, CampaignId : CampaignId, CampaignLevel1TerritoryId:CampaignLevel1TerritoryId, CampaignLevel2TerritoryId:CampaignLevel2TerritoryId},
	  dataType: "html"
	});
	 
	request.done(function( msg ) { 

	   location.reload();
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
}

function OnDeleteQRCode(QRCodeId)
{
	if (confirm("Are you sure you want to delete?") == true) {
		var request = $.ajax({
		  url: "DeleteQRCode",
		  method: "GET",
		  data: { QRCodeId : QRCodeId},
		  dataType: "html"
		});
		 
		request.done(function( msg ) { 
			$("#qrrow_"+QRCodeId).hide();
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  //alert( "Request failed: " + textStatus );
		});
	}
}

function OnSelectNFCTag(NFCTagId){

	var request = $.ajax({
	  url: "OnSelectNFCTag",
	  method: "GET",
	  data: { NFCTagId : NFCTagId},
	  dataType: "json"
	});
	 
	request.done(function( data ) {   
	   $("#ManufacturerName").val(data.ManufacturerName);
	   $("#RollNo").val(data.OriginatingRollId);
	   $("#TagBundleId").val(data.TagBundleId);
	   $("#NFCTagId").val(NFCTagId);


	   if($("#NumberOfTags").val() != '')
	   		OnChangeNumberOfTags($("#NumberOfTags").val());
	   
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
	
}

function OnChangeNumberOfTags(NumberOfTags){

	var NFCTagId = $("#NFCTagId").val();
	var NumberOfTags = parseInt(NumberOfTags);
	var StartingSequenceNo = parseInt($("#sq_start_"+NFCTagId).val()); 
	var MaxSequenceNo = parseInt($("#sq_end_"+NFCTagId).val());
	
	if((NumberOfTags + StartingSequenceNo) > MaxSequenceNo)
	{
		alert("Please enter valid number of tags.");
		$("#NumberOfTags").val(0);
		$("#StartingSequenceNo").val(0);
		$("#EndingSequenceNo").val(0);
	}
	else
	{ 
		
		$("#StartingSequenceNo").val(StartingSequenceNo);
	    $("#EndingSequenceNo").val(StartingSequenceNo + NumberOfTags);
	}
     
}

function OnClickToAddMoreTaps(){

	var maxField = 30;
    var wrapper = $('#add_more_taps_here'); 
    var cnt = $(":input[name='TapRedirectURL[]']").length + 1;
    
    if(cnt < maxField){ 
   
        var fieldHTML = '<div class="row" id="TapDiv_'+cnt+'" style="padding:10px;"><label class="col-sm-3 label-on-left">Tap '+cnt+' &nbsp;</label><div class="col-sm-6" style="border: 1px solid gray;border-radius:8px;"><label class="col-sm-2 label-on-left">Redirect URL</label><div class="col-sm-10"><div class="form-group label-floating"><label class ="control-label"></label><input class="form-control tap-field" type="text" name="TapRedirectURL[]" required="true" /></div></div></div><label class="col-sm-3 label-on-right"><a href="#" class="remove_button">X</a></label></div>';
   
        $(wrapper).append(fieldHTML); 

        cnt++;
    }

    $("#add_more_taps").attr("disabled",true);
    $("#campaign_save").attr("disabled",true);

}

$('#add_more_taps_here').on('click', '.remove_button', function(e){ 
    e.preventDefault();
    $(this).parent('label').parent('div').remove(); 
   
});

function OnClickToRemoveTaps(CampaignSequentialTapId){

   var request = $.ajax({
	  url: "RemoveTap",
	  method: "GET",
	  data: { CampaignSequentialTapId : CampaignSequentialTapId},
	  dataType: "json"
	});
	 
	request.done(function( data ) {   
	   $('#Tap_'+CampaignSequentialTapId).remove(); 
	});
	 
	request.fail(function( jqXHR, textStatus ) {
	  //alert( "Request failed: " + textStatus );
	});
}

$("#b2b_customer_campaign").on('change', '.form-control', function(e)
{ 
    e.preventDefault();
  	
  	var cnt = $('.form-control').filter(function(){
	    return !$(this).val();
	}).length;

  	if(cnt != 0)
  	{
  		$("#add_more_taps").attr("disabled",true);
  		$("#campaign_save").attr("disabled",true);
  	}
  	else
  	{
  		$("#add_more_taps").attr("disabled",false);
  		$("#campaign_save").attr("disabled",false);
  	}
	
});


