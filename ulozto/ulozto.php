<?php
// ###############################################################
// ##                                                           ##
// ##   http://sites.google.com/site/pavelbaco/                 ##
// ##   Copyright (C) 2012  Pavel Bačo   (killerman)            ##
// ##   Copyright (C) 2012  Jakub Pecháček (kumen)              ##
// ##                                                           ##
// ## This file is a part of xLiveCZ, this project doesnt have  ##
// ## any support from Xtreamer company and just be design for  ##
// ## realtek based players				 	##
// ###############################################################
echo "<?xml version='1.0' encoding='UTF8' ?>";
$DIR_SCRIPT_ROOT  = current(explode('xLiveCZ/', dirname(__FILE__).'/')).'xLiveCZ/';
$HTTP_SCRIPT_ROOT = current(explode('scripts/', 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/')).'scripts/';
?>
<!--Xtreamer Community 2011 - Killerman and Kumen-->
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
<script>
	setRefreshTime(-1);
	enablenextplay = 0;
	itemCount = getPageInfo("itemCount");
	SwitchViewer(7);
</script>

<onRefresh>
	if ( Integer( 1 + getFocusItemIndex() ) != getPageInfo("itemCount") && enablenextplay == 1 && playvideo == getFocusItemIndex()) {
		ItemFocus = getFocusItemIndex();
		setFocusItemIndex( Integer( 1 + getFocusItemIndex() ) );
		redrawDisplay();
		setRefreshTime(-1);
		"true";
	}

	if ( enablenextplay == 1 ) {
		enablenextplay = 0;
		url=getItemInfo(getFocusItemIndex(),"paurl");
		movie=getUrl(url);
		playItemUrl(movie,10);

		if ( Integer( 1 + getFocusItemIndex() ) == getPageInfo("itemCount") ) {
			enablenextplay = 0;
			setRefreshTime(-1);
		} else {
			playvideo = getFocusItemIndex();
			setRefreshTime(4000);
			enablenextplay = 1;
		}
	} else {
		setRefreshTime(-1);
		redrawDisplay();
		"true";
	}
</onRefresh>

<mediaDisplay name="threePartsView"
	sideLeftWidthPC="0"
	sideRightWidthPC="0"
	headerImageWidthPC="0"
	selectMenuOnRight="no"
	autoSelectMenu="no"
	autoSelectItem="no"
	itemImageHeightPC="0"
	itemImageWidthPC="0"
	itemXPC="3"
	itemYPC="25"
	itemWidthPC="52"
	itemHeightPC="8"
	capXPC="3"
	capYPC="25"
	capWidthPC="52"
	capHeightPC="64"
	itemBackgroundColor="0:0:0"
	itemPerPage="8"
    itemGap="0"
	bottomYPC="90"
	backgroundColor="0:0:0"
	showHeader="no"
	showDefaultInfo="no"
	imageFocus=""
	sliding="no" idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
>

 <text align="center" offsetXPC="2" offsetYPC="3" widthPC="54" heightPC="19" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
  	<text redraw="yes" offsetXPC="46" offsetYPC="15" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
	<text align="justify" redraw="yes"
          lines="9" fontSize=13
		      offsetXPC=58 offsetYPC=58 widthPC=40 heightPC=32
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="58" offsetYPC="53" widthPC="18" heightPC="5" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(durata); durata;</script>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="77" offsetYPC="53" widthPC="21" heightPC="5" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(pub); pub;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(titlu); titlu;</script>
		</text>
 <text align="center" offsetXPC="58.2" offsetYPC="0" widthPC="39.68" heightPC="52" fontSize="30" backgroundColor="130:130:130" foregroundColor="0:0:0">
		  <script>sprintf("Uloz.to",focus-(-1));</script>
		</text>
<image  redraw="yes" offsetXPC=59 offsetYPC=1 widthPC=38 heightPC=50>
		<script>print(img); img;</script>
		</image>
			<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy1.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy2.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy3.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy4.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy5.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy6.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy7.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy8.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy9.png</idleImage>

		<itemDisplay>
			<text align="left" lines="1" offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx)
					{
                      img = getItemInfo(idx,"image");
					  annotation = getItemInfo(idx, "annotation");
					  durata = getItemInfo(idx, "durata");
					  pub = getItemInfo(idx, "pub");
					  titlu = getItemInfo(idx, "title");
					}
					getItemInfo(idx, "title");
				</script>
				<fontSize>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "14"; else "14";
  				</script>
				</fontSize>
			  <backgroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "10:80:120"; else "-1:-1:-1";
  				</script>
			  </backgroundColor>
			  <foregroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "255:255:255"; else "140:140:140";
  				</script>
			  </foregroundColor>
			</text>

		</itemDisplay>
<onUserInput>
			<script>
				ret = "false";
				userInput = currentUserInput();
				if (userInput == "PD" || userInput == "PG" || userInput == "pagedown" || userInput == "pageup") {
					idx = Integer(getFocusItemIndex());
					if (userInput == "PD" || userInput == "pagedown") {
						idx -= -10;
						if (idx &gt;= getPageInfo("itemCount"))
							idx = 0;
					} else {
						idx -= 10;
						if (idx &lt; 0)
							idx = getPageInfo("itemCount")-1;
					}
					print("new idx: "+idx);
					setFocusItemIndex(idx);
					setItemFocus(0);
					redrawDisplay();
					ret = "true";
				} else
				if (userInput == "video_play" || userInput == "play") {
					showIdle();
					playvideo = getFocusItemIndex();
					url=getItemInfo(getFocusItemIndex(),"paurl");
					movie=getUrl(url);
					playItemUrl(movie,10);

					if( Integer(1+getFocusItemIndex()) == getPageInfo("itemCount") ) {
						enablenextplay = 0;
						setRefreshTime(-1);
					} else {
						setRefreshTime(4000);
						enablenextplay = 1;
					}
					cancelIdle();
					ret = "true";
				}
				if (userInput == "video_ffwd" || userInput == "ffwd") {
					showIdle();
					enablenextplay = 0;
					setRefreshTime(-1);
					cancelIdle();
					redrawDisplay();
					ret = "true";
				}
				ret;
</script>
</onUserInput>

	</mediaDisplay>
	<item_template>
		<mediaDisplay  name="threePartsView" idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10">
        	<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy1.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy2.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy3.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy4.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy5.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy6.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy7.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy8.png</idleImage>
		<idleImage><?php echo $DIR_SCRIPT_ROOT; ?>image/busy9.png</idleImage>
		</mediaDisplay>

	</item_template>
   <channel>
    <title>Vyhledávání Uloz.to</title>

    <item>
      <title>Vyhledávat na Uloz.to</title>
      <pubDate>Napište klíčová slova názvu videa</pubDate>
      <link>rss_command://search</link>
      <search url="<?php echo $HTTP_SCRIPT_ROOT; ?>xLiveCZ/ulozto/ulozto_find.php?query=0,%s" />
    </item>
	<!--
    <item>
      <title>Vložit odkaz na Uloz.to</title>
      <pubDate>Vložte část odkazu na uloz.to (Např.:"12345678/video-avi")</pubDate>
      <link>rss_command://search</link>
      <search url="<?php echo $HTTP_SCRIPT_ROOT; ?>xLiveCZ/ulozto/ulozto_link.php?url=http://www.uloz.to/%s" />
    </item>
	-->
	<item>
      <title>Uloz.to LIVE</title>
      <link><?php echo $HTTP_SCRIPT_ROOT; ?>xLiveCZ/ulozto/uloztolive.php</link>
    </item>
	<item>
      <title>Vyhledávat na Uloz.to LIVE</title>
      <link><?php echo $HTTP_SCRIPT_ROOT; ?>xLiveCZ/ulozto/uloztolive.php?action=hledat</link>
    </item>
  </channel>
</rss>
