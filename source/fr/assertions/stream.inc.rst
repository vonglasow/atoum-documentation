.. _stream-anchor:

stream
******

Assertion dédiée aux flux.

Elle est basée sur le système de fichier virtuel d'atoum (VFS). Un nouveau `stream wrapper <http://php.net/manual/fr/class.streamwrapper.php>`_ sera enregistré (qui commence par ``atoum://``).

Le bouchon va créer un nouveau fichier dans le VFS et le chemin du flux sera accessible en appellant la méthode ``getPath`` sur le controlleur de flux (par exemple ``atoum://mockUniqId``).

.. _is-read:

isRead
======

``isRead`` vérifie si le flux bouchoné à bien été lu.

.. code-block:: php

   <?
   $this
       ->given(
           $streamController = \atoum\mock\stream::get(),
           $streamController->file_get_contents = 'myFakeContent'
       )
       ->if(file_get_contents($streamController->getPath()))
       ->stream($streamController)
           ->isRead() // passe
   ;

   $this
       ->given(
           $streamController = \atoum\mock\stream::get(),
           $streamController->file_get_contents = 'myFakeContent'
       )
       ->if() //we do nothing
       ->stream($streamController)
           ->isRead() // échoue
   ;


.. _is-written:

isWritten
=========

``isWritten`` vérifie si le flux bouchoné à bien été écrit.

.. code-block:: php

   <?
   $this
       ->given(
           $streamController = \atoum\mock\stream::get(),
           $streamController->file_put_contents = strlen($content = 'myTestContent')
       )
       ->if(file_put_contents($streamController->getPath(), $content))
       ->stream($streamController)
           ->isWritten() // passe
   ;

   $this
      ->given(
        $streamController = \atoum\mock\stream::get(),
        $streamController->file_put_contents = strlen($content = 'myTestContent')
      )
      ->if() //we do nothing
      ->stream($streamController)
         ->isWritten() // échoue
   ;


.. _is-writed:

isWrited
========

.. hint::
``isWrited`` est un alias de la méthode ``isWritten``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`stream::isWritten <is-written>`



