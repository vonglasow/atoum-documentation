Amusons-nous avec atoum
#######################

Rapport
*******
Les rapports de tests peuvent être décorés afin d'être plus agréable ou sympa à lire. 
Pour cela, dans le :ref:`fichier de configuration <fichier-de-configuration>` d'atoum, ajoutez le code suivant

.. code-block:: php

	<?php
	// by default .atoum.php
	// ...

	$stdout = new \mageekguy\atoum\writers\std\out;
	$report = new \mageekguy\atoum\reports\realtime\nyancat;
	$script->addReport($report->addWriter($stdout));
