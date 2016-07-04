<?php
##### Imgage Functions ####

function create_thumb($path,$size,$save_path,$mid)
{	
	if (file_exists($path))
	{


//echo $path.'==='.$size.'====='.$save_path;exit;
		/*if(strstr(strtolower($path),".gif")!="")
		{			
			echo "Not Supported File";
			exit();	
		}
		else
		{*/
			
				$thumb=new my_thumbnail($path);	// generate image_file, set filename to resize
				$thumb->size_width(869);		// set width for thumbnail, or
				$thumb->size_height(70);		// set height for thumbnail, or

				$width=$thumb->img["lebar"];
				$height=$thumb->img["tinggi"];
				if($width>$size || $height>$size)
				{
					$size=70;//$size
				}
				else
				{
					$size=70;//$width
				}
				
				$thumb->size_auto($size);		// set the biggest width or height for thumbnail
				$thumb->jpeg_quality(75);		// [OPTIONAL] set quality for jpeg only (0 - 100) (worst - best), default = 75
			     //echo $path.'==='.$size.'====='.$save_path;	exit;
			     //echo $thumb->show();				// show your thumbnail
				$thumb->save($save_path);		// save your thumbnail to file

		//}
			
	}
	else
	{
				return false;
	}
}
/*----------------------------------------------Changes by Diksha Srivastava*/
function create_mid($path,$size,$save_path)
{	
	if (file_exists($path))
	{

				$thumb=new my_thumbnail($path);	// generate image_file, set filename to resize
				$thumb->size_width(869);		// set width for thumbnail, or
				$thumb->size_height(350);		// set height for thumbnail, or

				$width=$thumb->img["lebar"];
				$height=$thumb->img["tinggi"];
				if($width>$size || $height>$size)
				{
					$size=350;//$size
				}
				else
				{
					$size=350;//$width
				}
				
				$thumb->size_auto($size);		// set the biggest width or height for thumbnail
				$thumb->jpeg_quality(75);		// [OPTIONAL] set quality for jpeg only (0 - 100) (worst - best), default = 75
			     //echo $path.'==='.$size.'====='.$save_path;	exit;
			     //echo $thumb->show();				// show your thumbnail
				$thumb->save($save_path);		// save your thumbnail to file

		//}
			
	}
	else
	{
				return false;
	}
}


class my_thumbnail
{
	
	var $img;

	function my_thumbnail($imgfile)
	{
		//
		//detect image format
		$this->img["format"]=ereg_replace(".*\.(.*)$","\\1",$imgfile);
		$this->img["format"]=strtoupper($this->img["format"]);
		if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") {
			//JPEG
			
			$this->img["format"]="JPEG";
			$this->img["src"] = ImageCreateFromJPEG ($imgfile);

			
		} elseif ($this->img["format"]=="PNG") {
			//PNG
			$this->img["format"]="PNG";
			$this->img["src"] = ImageCreateFromPNG ($imgfile);
		} elseif ($this->img["format"]=="GIF") {
			//GIF
			$this->img["format"]="GIF";
			$this->img["src"] = ImageCreateFromGIF ($imgfile);
		} elseif ($this->img["format"]=="WBMP") {
			//WBMP
			$this->img["format"]="WBMP";
			$this->img["src"] = ImageCreateFromWBMP ($imgfile);
		} else {
			//DEFAULT
			echo "Not Supported File";
			exit();
		}

		@$this->img["lebar"] = imagesx($this->img["src"]);
		@$this->img["tinggi"] = imagesy($this->img["src"]);
		
		//default quality jpeg
		$this->img["quality"]=100;
	}

	function size_height($size=70)
	{
		//height
    	$this->img["tinggi_thumb"]=$size;
    	//$this->img["tinggi_thumb"]="260";

    	@$this->img["lebar_thumb"] = ($this->img["tinggi_thumb"]/$this->img["tinggi"])*$this->img["lebar"];
	}

	function size_width($size=869)
	{
		//width
		$this->img["lebar_thumb"]=$size;
		//$this->img["lebar_thumb"]="568";
    	@$this->img["tinggi_thumb"] = ($this->img["lebar_thumb"]/$this->img["lebar"])*$this->img["tinggi"];
	}

	function size_auto($size=100)
	{
		//size
		if ($this->img["lebar"]>=$this->img["tinggi"]) {
    		$this->img["lebar_thumb"]=$size;
    		@$this->img["tinggi_thumb"] = ($this->img["lebar_thumb"]/$this->img["lebar"])*$this->img["tinggi"];
		} else {
	    	$this->img["tinggi_thumb"]=$size;
    		@$this->img["lebar_thumb"] = ($this->img["tinggi_thumb"]/$this->img["tinggi"])*$this->img["lebar"];
 		}
	}

	function jpeg_quality($quality)
	{
		//jpeg quality
		$this->img["quality"]=$quality;
	}

	function show()
	{
		//show thumb
		@Header("Content-Type: image/".$this->img["format"]);

		/* change ImageCreateTrueColor to ImageCreate if your GD not supported ImageCreateTrueColor function*/
		$this->img["des"] = ImageCreateTrueColor($this->img["lebar_thumb"],$this->img["tinggi_thumb"]);
    		imagecopyresampled ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["lebar_thumb"], $this->img["tinggi_thumb"], $this->img["lebar"], $this->img["tinggi"]);

		if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") {
			//JPEG
			imageJPEG($this->img["des"],"",$this->img["quality"]);
		} elseif ($this->img["format"]=="PNG") {
			//PNG
			imagePNG($this->img["des"]);
		} elseif ($this->img["format"]=="GIF") {
			//GIF
			imageGIF($this->img["des"]);
//			echo "$path";

		} elseif ($this->img["format"]=="WBMP") {
			//WBMP
			imageWBMP($this->img["des"]);
		}
	}

	function save($save="")
	{
		//save thumb
		if (empty($save)) $save=strtolower("./thumb.".$this->img["format"]);
		/* change ImageCreateTrueColor to ImageCreate if your GD not supported ImageCreateTrueColor function*/
		$this->img["des"] = ImageCreateTrueColor($this->img["lebar_thumb"],$this->img["tinggi_thumb"]);
		//$this->img["des"] = ImageCreateTrueColor(658,260);
    		@imagecopyresampled ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["lebar_thumb"], $this->img["tinggi_thumb"], $this->img["lebar"], $this->img["tinggi"]);
			//@imagecopyresampled ($this->img["des"], $this->img["src"], 0, 0, 0, 0, 658, 260, $this->img["lebar"], $this->img["tinggi"]);

		if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") {
			//JPEG
			imageJPEG($this->img["des"],"$save",$this->img["quality"]);
		} elseif ($this->img["format"]=="PNG") {
			//PNG
			imagePNG($this->img["des"],"$save");
		} elseif ($this->img["format"]=="GIF") {
			//GIF
			imageGIF($this->img["des"],"$save");
		} elseif ($this->img["format"]=="WBMP") {
			//WBMP
			imageWBMP($this->img["des"],"$save");
		}
	}
}

#####################################
?>