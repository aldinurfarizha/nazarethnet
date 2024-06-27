	<nav class="nav-bar-container">
	    <nav class="nav-bar">
		    <div class="nav-bar__logo">
			    <a href="<?php echo base_url();?>">
				    <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" class="head-logo">
		    	</a>
		    </div>
		    <input type="checkbox" id="menu-toggle" class="nav-bar__toggle"/>
		    <label for="menu-toggle" class="nav-bar__hamburger nav-bar__hamburger--open">
			    <svg width="25px" height="20px" viewBox="0 0 90 60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<g id="Icon/menu" fill="#2B80FF" fill-rule="nonzero">
    						<g id="noun_421368_cc">
	    						<g id="Group">
		    						<path d="M85.5,0 L4.5,0 C2.015,0 0,2.015 0,4.5 C0,6.985 2.015,9 4.5,9 L85.5,9 C87.985,9 90,6.985 90,4.5 C90,2.015 87.985,0 85.5,0 Z" id="Shape"></path>
			    					<path d="M85.5,51 L4.5,51 C2.015,51 0,53.015 0,55.5 C0,57.985 2.015,60 4.5,60 L85.5,60 C87.985,60 90,57.985 90,55.5 C90,53.015 87.985,51 85.5,51 Z" id="Shape"></path>
				    				<path d="M85.5,25 L4.5,25 C2.015,25 0,27.015 0,29.5 C0,31.985 2.015,34 4.5,34 L85.5,34 C87.985,34 90,31.985 90,29.5 C90,27.015 87.985,25 85.5,25 Z" id="Shape"></path>
					    		</g>
						    </g>
					    </g>
				    </g>
			    </svg>
		    </label>
		    <div class="background-dim"></div>
		    <div class="nav-menu">
			    <div class="nav-menu__mobile-logo">
				    <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" class="head-logo">
			    </div>
			    <label for="menu-toggle" class="nav-bar__hamburger nav-bar__hamburger--close">
				    <svg width="19px" height="19px" viewBox="0 0 19 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						    <g id="Icon/close" fill="#2B80FF" fill-rule="nonzero">
							    <path d="M18.7216263,0.313540773 C18.3044296,-0.104447597 17.6275734,-0.104447597 17.2103767,0.313144951 L9.5282571,7.98932721 L1.84534586,0.313144951 C1.42814914,-0.104447597 0.75129297,-0.104447597 0.334096244,0.313540773 C-0.0831004814,0.731133321 -0.0831004814,1.40798949 0.334887889,1.82479039 L8.01582001,9.49978518 L0.334887889,17.17478 C-0.0831004814,17.5919767 -0.0831004814,18.268437 0.334096244,18.6856338 C0.542694607,18.894628 0.816603653,18.999125 1.09011688,18.999125 C1.3636301,18.999125 1.63714332,18.894628 1.84534586,18.6864254 L9.52786128,11.0102432 L17.2099809,18.6864254 C17.4185792,18.894628 17.6920925,18.999125 17.9652099,18.999125 C18.2391189,18.999125 18.5126321,18.894628 18.7212305,18.6856338 C19.1384272,18.2680412 19.1384272,17.5915809 18.7204388,17.17478 L11.0395067,9.49978518 L18.7204388,1.82479039 C19.138823,1.40798949 19.138823,0.731133321 18.7216263,0.313540773 Z" id="Shape"></path>
					    	</g>
					    </g>
				    </svg>
			    </label>
			    <ul class="nav-menu__primary">
				    <li class="nav-itm"><a href="<?php echo base_url();?>" <?php if($page_name == 'home'):?>class="current"<?php endif;?>><?php echo getEduAppGTLang('home');?></a></li>
			    	<li class="nav-itm"><a href="<?php echo base_url();?>about/" <?php if($page_name == 'about'):?>class="current"<?php endif;?>><?php echo getEduAppGTLang('about_us');?></a></li>
                    <li class="nav-itm"><a href="<?php echo base_url();?>teachers/" <?php if($page_name == 'teachers'):?>class="current"<?php endif;?>><?php echo getEduAppGTLang('teachers');?></a></li>
			    	<li class="nav-itm nav-dropdown-menu">
				    	<label tabindex="0" for="drop-resources" class="nav-dropdown-menu__toggle--mobile"><?php echo getEduAppGTLang('resources');?> <i class="fas fa-chevron-down"></i></label>
					    <a tabindex="0" class="nav-dropdown-menu__toggle--desktop"><?php echo getEduAppGTLang('resources');?> <i class="fas fa-chevron-down"></i></a>
					    <input type="checkbox" id="drop-resources">
					    <ul class="nav-dropdown-menu__content nav-dropdown-menu__content--one-col">
						    <li><a href="<?php echo base_url();?>news/"><i class="picons-thin-icon-thin-0133_arrow_right_next"></i>  <?php echo getEduAppGTLang('news');?></a></li>
						    <li><a href="<?php echo base_url();?>gallery/"><i class="picons-thin-icon-thin-0133_arrow_right_next"></i>  <?php echo getEduAppGTLang('gallery');?></a></li>
                            <li><a href="<?php echo base_url();?>contact/" <?php if($page_name == 'contact'):?>class="current"<?php endif;?>><i class="picons-thin-icon-thin-0133_arrow_right_next"></i>  <?php echo getEduAppGTLang('contact_us');?></a></li>
					    </ul>
				    </li>
			    </ul>
			    <ul class="nav-menu__secondary">
				    <li class="nav-itm"><a href="<?php echo base_url();?>login/" class="nav-menu__secondary__log-in btn btn-dark-o "><?php echo getEduAppGTLang('sign_in');?></a></li>
				    <li class="nav-itm"><a href="<?php echo base_url();?>register/" class="nav-menu__secondary__trial btn btn-primary signup-button"><?php echo getEduAppGTLang('sign_up');?></a></li>
			    </ul>
		    </div>
	    </nav>
    </nav>