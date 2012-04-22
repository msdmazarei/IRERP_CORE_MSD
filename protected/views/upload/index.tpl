   {literal}
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href={/literal}"{$this->baseUrl}/css/fileuploader.css"{literal} rel="stylesheet" type="text/css">	
   
<div>
<!-- 
	<div align="center">
	برای بارگذاری پرونده خود روی دکمه زیر کلیک کرده و پرونده 
	مورد نظر خود را انتخاب کنید و سپس منتظر بمانید.
	
	</div>
	<br/>
	<div align="center">
	برای حذف مورد ارسال شده دکمه حذف را فشار دهید
	</div>
	 -->		
	<div id="file-uploader-demo1" align="center">		
		<noscript>			
			<p>Please enable JavaScript to use file uploader.</p>
			<!-- or put a simple form for upload here -->
		</noscript>    
	</div>
	<div id="UploadButton"></div>
	<div id="FileUploadedSuccessFull" style="display: none;">Upload Success</div>
	<div id="FileUploadedFailed" style="display: none;">Upload Failed</div>
	<div id="CancelUploadFile" style="display: none;">Uploading File Canceled</div>
	<div id="FileUploadedRemoveSuccess" style="display: none;">Remove Uploaded File SuccessFull</div>
	<div id="FileUploadedRemoveFailed" style="display: none;">Remove Uploaded File Failed</div>
	<div id="RemoveButton" style="display: none;">
	<a href="#" onclick="removeFileFromServer()">
		<div class="qq-remove-button">حذف پرونده بارگذاری شده</div>
	</a>
	</div>
    <div align="center" id="files"></div>
    </div>
    <script src={/literal}"{$this->baseUrl}/js/fileuploader.js"{literal} type="text/javascript"></script>
    <script src={/literal}"{$this->baseUrl}/js/jquery-1.6.4.min.js"{literal} type="text/javascript"></script>
    <script>
    
    	var IsFileUploaded=false;
    	var FileNameInServer='';
    	var RequestToUpload=-1;
    	window.getFileName = function(){return FileNameInServer;}
    	window.onFileUploadSuccess=function(){
        	
        	document.getElementById('FileUploadedSuccessFull').style.display='';
        	document.getElementById('FileUploadedFailed').style.display='none';
        	document.getElementById('CancelUploadFile').style.display='none';
        	document.getElementById('FileUploadedRemoveSuccess').style.display='none';
        	document.getElementById('FileUploadedRemoveFailed').style.display='none';
        	//Hide Upload Button
        	document.getElementById('file-uploader-demo1').style.display='none';
        	document.getElementById('UploadButton').style.display='none';
        	//Show Remove Botton
        	document.getElementById('RemoveButton').style.display='';
        	
        	
    	}
    	window.onCancelUploadFile=function(){
    		document.getElementById('FileUploadedSuccessFull').style.display='none';
        	document.getElementById('FileUploadedFailed').style.display='none';
        	document.getElementById('FileUploadedRemoveSuccess').style.display='none';
        	document.getElementById('FileUploadedRemoveFailed').style.display='none';
        	document.getElementById('CancelUploadFile').style.display='';
        	//show Upload Button
        	document.getElementById('file-uploader-demo1').style.display='';
        	document.getElementById('UploadButton').style.display='';
        	//hide Remove Botton
        	document.getElementById('RemoveButton').style.display='none';
        	
    	}
    	
    	window.onFileUploadFailed = function(){
    		document.getElementById('CancelUploadFile').style.display='none';
    		document.getElementById('FileUploadedSuccessFull').style.display='none';
        	document.getElementById('FileUploadedFailed').style.display='';
        	document.getElementById('FileUploadedRemoveSuccess').style.display='none';
        	document.getElementById('FileUploadedRemoveFailed').style.display='none';
        	//show Upload Button
        	document.getElementById('file-uploader-demo1').style.display='';
        	document.getElementById('UploadButton').style.display='';
        	//hide Remove Botton
        	document.getElementById('RemoveButton').style.display='none';
        	    	}
    	window.onFileUploadedRemoveSuccess = function(){
    		document.getElementById('CancelUploadFile').style.display='none';
    		document.getElementById('FileUploadedSuccessFull').style.display='none';
        	document.getElementById('FileUploadedFailed').style.display='none';
        	document.getElementById('FileUploadedRemoveSuccess').style.display='';
        	document.getElementById('FileUploadedRemoveFailed').style.display='none';
        	//show Upload Button
        	document.getElementById('file-uploader-demo1').style.display='';
        	document.getElementById('UploadButton').style.display='';
        	//hide Remove Botton
        	document.getElementById('RemoveButton').style.display='none';
        	    	}

    	window.onFileUploadedRemoveFailed=function(){
    		document.getElementById('CancelUploadFile').style.display='none';
    		document.getElementById('FileUploadedSuccessFull').style.display='none';
        	document.getElementById('FileUploadedFailed').style.display='none';
        	document.getElementById('FileUploadedRemoveSuccess').style.display='none';
        	document.getElementById('FileUploadedRemoveFailed').style.display='';
        	//hife Upload Button
        	document.getElementById('file-uploader-demo1').style.display='none';
        	document.getElementById('UploadButton').style.display='none';
        	//hide Remove Botton
        	document.getElementById('RemoveButton').style.display='';
    	}
    	
    	
    	function removeFileFromServer(){
    		$.ajax({
    			   type: "POST",
    			   url: {/literal}"{$this->baseUrl}/{$this->uniqueId}/remove",{literal}
    			   data: "filename="+FileNameInServer,
    			   success: function(msg){
    			     //Clear File Lists
    			     try{
    				   var filelist=document.getElementById('file-uploader-demo1').childNodes[0].childNodes[2];
    				   if(filelist!=null){
    				   for(var i=0;i<filelist.childNodes.length;i++) filelist.removeChild(filelist.childNodes[0]);
    				   var filelist=document.getElementById('files');
    				   for(var i=0;i<filelist.childNodes.length;i++) filelist.removeChild(filelist.childNodes[0]);
    				   }
    			     }catch(err){}
    				   FileNameInServer='';
    				   IsFileUploaded=false;
    				   document.getElementById('file-uploader-demo1').childNodes[0].childNodes[1].style.display="";
    				   RequestToUpload=-1;
    				   window.onFileUploadedRemoveSuccess();
          			   },
          			error:function(){
          				window.onFileUploadedRemoveFailed();
          				alert('خطا درعملیات حذف');
          			}
    			 });
    	}
    	
        function createUploader(){            
            var uploader = new qq.FileUploader({
                element: document.getElementById('file-uploader-demo1'),
                action: {/literal}'{$this->baseUrl}/{$this->uniqueId}/upload',{literal}
                debug: false,
                onSubmit:function(id, fileName){
                	
                	if(RequestToUpload!=-1) return false;
                	RequestToUpload=id;
                	if(IsFileUploaded) {
                		alert('قبل از افزودن پرونده جدید پرونده افزوده شده را حذف کنید');
                		return false;
                	}
                },
                onComplete: function(id, fileName, responseJSON){
                	RequestToUpload=-1;
    				//On completion clear the status
    				//status.text('');
    				//Add uploaded file to list
    				if(responseJSON.success){
    					/*var link = document.createElement("a");
    					link.setAttribute('href', '#');
    					link.setAttribute('onclick','removeFileFromServer()');
    					link.innerHTML='<div class="qq-remove-button">حذف پرونده بارگذاری شده</div>';
    					document.getElementById('files').appendChild(link);*/
    					document.getElementById('file-uploader-demo1').childNodes[0].childNodes[1].style.display="none";
    					window.onFileUploadSuccess()
       			       
    					
    					try{
    					if(responseJSON.ServerFileName)
    					{FileNameInServer=responseJSON.ServerFileName;
    					IsFileUploaded=true;}
    					else{FileNameInServer=fileName;
    					IsFileUploaded=true;}
    					}catch(err){FileNameInServer=fileName;IsFileUploaded=true;}
    					
    				} else{
    					window.onFileUploadFailed();
    				}
    			},
		onCancel: function(id, fileName){
			window.onCancelUploadFile();

			//alert('Masoud Saied: Why You Canceled file '+fileName+'?');
			},

            });           
        }
        
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
        window.onload = createUploader;     
    </script>    

{/literal}