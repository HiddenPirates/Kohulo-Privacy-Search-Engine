<footer>
	<div class="footer-social-link">
		<ul>

			<?php

			if (getSocialLinks()['facebook'] !== "no link") {
				echo '<a target="_blank" href="https://facebook.com/'.getSocialLinks()['facebook'].'"><li data-tippy-content="Facebook"><span><i class="fab fa-facebook-f"></i></span></li></a>';
			}

			if (getSocialLinks()['instagram'] !== "no link") {
				echo '<a target="_blank" href="https://www.instagram.com/'.getSocialLinks()['instagram'].'"><li data-tippy-content="Instagram"><span><i class="fab fa-instagram"></i></span></li></a>';
			}

			if (getSocialLinks()['youtube'] !== "no link") {
				echo '<a target="_blank" href="https://www.youtube.com/'.getSocialLinks()['youtube'].'"><li data-tippy-content="YouTube"><span><i class="fab fa-youtube"></i></span></li></a>';
			}

			if (getSocialLinks()['github'] !== "no link") {
				echo '<a target="_blank" href="https://github.com/'.getSocialLinks()['github'].'"><li data-tippy-content="GitHub"><span><i class="fab fa-github"></i></span></li></a>';
				}
			?>

		</ul>
	</div>

	<div class="footer-links">
		<ul>
			<a href="page/about"><li>About</li></a>
			<a href="page/contact"><li>Contact</li></a>
			<a href="page/privacy"><li>Privacy</li></a>
		</ul>
	</div>

	<div class="footer-copyright">
		<span>&#169;Copyright - <b><?=date("Y");?> <a href="index" style="text-transform: capitalize;"><?=substr_replace($site_host_name,"",-1);?></a></b></span>
	</div>
</footer>