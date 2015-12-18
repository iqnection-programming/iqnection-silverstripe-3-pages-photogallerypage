<?php
	class GalleryPage extends Page
	{
	    private static $icon = "iq-photogallerypage/images/icon-gallerypage";
		
	    private static $db = array(
			"Type" => "Varchar(255)",
			'ThumbnailWidth' => 'Int',
			'ThumbnailHeight' => 'Int',
		);
		
	    private static $allowed_children = array(
			"GalleryPage",
			"AlbumPage"
		);
		
	    private static $defaults = array(
			'ThumbnailWidth' => '340',
			'ThumbnailHeight' => '340',
		);
		
	    public function getCMSFields()
	    {
	        $fields = parent::getCMSFields();
	        $fields->addFieldToTab("Root.GallerySetup", new LiteralField("Desc1", "<p>The layout chosen below will affect all galleries under this page.  You may override this layout choice on individual gallery pages if you wish.</p><br />"));
	        $fields->addFieldToTab("Root.GallerySetup", new OptionsetField("Type", "Choose your layout:", array(
				"All-In-One" => "<span>All-In-One<br /><img src='/iq-photogallerypage/css/images/photo_gallery_layout_1.gif' /></span>", 
				"Large Thumbnails" => "<span>Large Thumbnails<br /><img src='/iq-photogallerypage/css/images/photo_gallery_layout_2.gif' /></span>"
			)));
//			$fields->addFieldToTab("Root.Content.GallerySetup", new LiteralField("Picture1", "<br /><div style='float:left;'><h2>All-In-One</h2><img src='/iq-photogallerypage/css/images/photo_gallery_layout_1.gif' /></div>"));
//			$fields->addFieldToTab("Root.Content.GallerySetup", new LiteralField("Picture2", "<div style='float:left; margin-left:10px;'><h2>Large Thumbnails</h2><img src='/iq-photogallerypage/css/images/photo_gallery_layout_2.gif' /></div>"));
			
			if (Permission::check('ADMIN')) {
			    $fields->addFieldToTab('Root.GallerySetup', new HeaderField('head1', 'Layout 2 Setup'));
			    $fields->addFieldToTab('Root.GallerySetup', new NumericField('ThumbnailWidth', 'Thumbnail Width (default: 340)'));
			    $fields->addFieldToTab('Root.GallerySetup', new NumericField('ThumbnailHeight', 'Thumbnail Height (default: 340)'));
			}
			
	        return $fields;
	    }
		
	    public function GalleryThumbnailURL()
	    {
	        return $this->Children()->First()->GalleryThumbnailURL();
	    }
		
	    public function GalleryThumbnailAlt()
	    {
	        return $this->Children()->First()->GalleryThumbnailAlt();
	    }
	}
	  
	class GalleryPage_Controller extends Page_Controller
	{
	    public function init()
	    {
	        parent::init();
	    }	
		
	    public function PageCSS()
	    {
	        return array_merge(
				array(
					"iq-photogallerypage/css/pages/GalleryPage.css"
				),
				parent::PageCSS()
			);
	    }
	}  
?>