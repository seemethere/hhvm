<?hh // partial

// This doc comment block generated by idl/sysdoc.php
/**
 * ( excerpt from http://php.net/manual/en/class.phardata.php )
 *
 * The PharData class provides a high-level interface to accessing and
 * creating non-executable tar and zip archives. Because these archives do
 * not contain a stub and cannot be executed by the phar extension, it is
 * possible to create and manipulate regular zip and tar files using the
 * PharData class even if phar.readonly php.ini setting is 1.
 *
 */
class PharData extends Phar {
  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.construct.php )
   *
   *
   * @fname      mixed   Path to an existing tar/zip archive or to-be-created
   *                     archive
   * @flags      mixed   Flags to pass to Phar parent class
   *                     RecursiveDirectoryIterator.
   * @alias      mixed   Alias with which this Phar archive should be
   *                     referred to in calls to stream functionality.
   * @format     mixed   One of the file format constants available within
   *                     the Phar class.
   */
  public function __construct(
    string $fname,
    int $flags = null,
    string $alias = null,
    int $format = Phar::TAR
  ) {
    $this->iteratorRoot = 'phar://'.realpath($fname).'/';
    $this->fname = $fname;
    if (substr($fname, -4) === '.zip' || $format === Phar::ZIP) {
      $this->archiveHandler = new __SystemLib\ZipArchiveHandler($fname);
    } else {
      $this->archiveHandler = new __SystemLib\TarArchiveHandler($fname);
    }
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.addemptydir.php )
   *
   * With this method, an empty directory is created with path dirname. This
   * method is similar to ZipArchive::addEmptyDir().
   *
   * @dirname    mixed   The name of the empty directory to create in the
   *                     phar archive
   *
   * @return     mixed   no return value, exception is thrown on failure.
   */
  public function addEmptyDir(string $dirname) {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.addfromstring.php )
   *
   * With this method, any string can be added to the tar/zip archive. The
   * file will be stored in the archive with localname as its path. This
   * method is similar to ZipArchive::addFromString().
   *
   * @localname  mixed   Path that the file will be stored in the archive.
   * @contents   mixed   The file contents to store
   *
   * @return     mixed   no return value, exception is thrown on failure.
   */
  public function addFromString(string $localname, string $contents) {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.buildfromiterator.php
   * )
   *
   * Populate a tar or zip archive from an iterator. Two styles of iterators
   * are supported, iterators that map the filename within the tar/zip to the
   * name of a file on disk, and iterators like DirectoryIterator that return
   * SplFileInfo objects. For iterators that return SplFileInfo objects, the
   * second parameter is required.
   *
   * @iter       mixed   Any iterator that either associatively maps tar/zip
   *                     file to location or returns SplFileInfo objects
   * @base_directory
   *             mixed   For iterators that return SplFileInfo objects, the
   *                     portion of each file's full path to remove when
   *                     adding to the tar/zip archive
   *
   * @return     mixed   PharData::buildFromIterator() returns an associative
   *                     array mapping internal path of file to the full path
   *                     of the file on the filesystem.
   */
  public function buildFromIterator(
    Iterator $it,
    string $base_directory = '',
  ): array<string, string> {
    if ($base_directory !== '' && substr($base_directory, -1) !== '/') {
      $base_directory .= '/';
    }
    $ret = array();
    foreach ($it as $dest => $source) {
      if ($source is SplFileInfo) {
        $source = $source->getPathName();
        $dest = str_replace($base_directory, '', $source);
      }
      if ($this->archiveHandler->addFile($source, $dest)) {
        $ret[$dest] = realpath($source);
      }
    }
    $this->archiveHandler->close();
    return $ret;
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.compress.php )
   *
   * For tar archives, this method compresses the entire archive using gzip
   * compression or bzip2 compression. The resulting file can be processed
   * with the gunzip command/bunzip command, or accessed directly and
   * transparently with the Phar extension.
   *
   * For zip archives, this method fails with an exception. The zlib
   * extension must be enabled to compress with gzip compression, the bzip2
   * extension must be enabled in order to compress with bzip2 compression.
   *
   * In addition, this method automatically renames the archive, appending
   * .gz, .bz2 or removing the extension if passed Phar::NONE to remove
   * compression. Alternatively, a file extension may be specified with the
   * second parameter.
   *
   * @compression
   *             mixed   Compression must be one of Phar::GZ, Phar::BZ2 to
   *                     add compression, or Phar::NONE to remove
   *                     compression.
   * @extension  mixed   By default, the extension is .tar.gz or .tar.bz2 for
   *                     compressing a tar, and .tar for decompressing.
   *
   * @return     mixed   A PharData object is returned.
   */
  public function compress(int $compression, string $extension) {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.compressfiles.php )
   *
   * For tar-based archives, this method throws a BadMethodCallException, as
   * compression of individual files within a tar archive is not supported by
   * the file format. Use PharData::compress() to compress an entire
   * tar-based archive.
   *
   * For Zip-based archives, this method compresses all files in the archive
   * using the specified compression. The zlib or bzip2 extensions must be
   * enabled to take advantage of this feature. In addition, if any files are
   * already compressed using bzip2/zlib compression, the respective
   * extension must be enabled in order to decompress the files prior to
   * re-compressing.
   *
   * @compression
   *             mixed   Compression must be one of Phar::GZ, Phar::BZ2 to
   *                     add compression, or Phar::NONE to remove
   *                     compression.
   *
   * @return     mixed   Returns TRUE on success or FALSE on failure.
   */
  public function compressFiles(int $compression) {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.converttodata.php )
   *
   * This method is used to convert a non-executable tar or zip archive to
   * another non-executable format.
   *
   * If no changes are specified, this method throws a
   * BadMethodCallException. This method should be used to convert a tar
   * archive to zip format or vice-versa. Although it is possible to simply
   * change the compression of a tar archive using this method, it is better
   * to use the PharData::compress() method for logical consistency.
   *
   * If successful, the method creates a new archive on disk and returns a
   * PharData object. The old archive is not removed from disk, and should be
   * done manually after the process has finished.
   *
   * @format     mixed   This should be one of Phar::TAR or Phar::ZIP. If set
   *                     to NULL, the existing file format will be preserved.
   * @compression
   *             mixed   This should be one of Phar::NONE for no
   *                     whole-archive compression, Phar::GZ for zlib-based
   *                     compression, and Phar::BZ2 for bzip-based
   *                     compression.
   * @extension  mixed   This parameter is used to override the default file
   *                     extension for a converted archive. Note that .phar
   *                     cannot be used anywhere in the filename for a
   *                     non-executable tar or zip archive.
   *
   *                     If converting to a tar-based phar archive, the
   *                     default extensions are .tar, .tar.gz, and .tar.bz2
   *                     depending on specified compression. For zip-based
   *                     archives, the default extension is .zip.
   *
   * @return     mixed   The method returns a PharData object on success and
   *                     throws an exception on failure.
   */
  public function convertToData(
    int $format,
    int $compression,
    string $extension
  ) {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.converttoexecutable.php
   * )
   *
   *
   * @format     mixed   This should be one of Phar::PHAR, Phar::TAR, or
   *                     Phar::ZIP. If set to NULL, the existing file format
   *                     will be preserved.
   * @compression
   *             mixed   This should be one of Phar::NONE for no
   *                     whole-archive compression, Phar::GZ for zlib-based
   *                     compression, and Phar::BZ2 for bzip-based
   *                     compression.
   * @extension  mixed   This parameter is used to override the default file
   *                     extension for a converted archive. Note that all
   *                     zip- and tar-based phar archives must contain .phar
   *                     in their file extension in order to be processed as
   *                     a phar archive.
   *
   *                     If converting to a phar-based archive, the default
   *                     extensions are .phar, .phar.gz, or .phar.bz2
   *                     depending on the specified compression. For
   *                     tar-based phar archives, the default extensions are
   *                     .phar.tar, .phar.tar.gz, and .phar.tar.bz2. For
   *                     zip-based phar archives, the default extension is
   *                     .phar.zip.
   *
   * @return     mixed   The method returns a Phar object on success and
   *                     throws an exception on failure.
   */
  public function convertToExecutable(
    int $format,
    int $compression,
    string $extension
  ) {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.copy.php )
   *
   * Copy a file internal to the tar/zip archive to another new file within
   * the same archive. This is an object-oriented alternative to using copy()
   * with the phar stream wrapper.
   *
   * @oldfile    mixed
   * @newfile    mixed
   *
   * @return     mixed   returns TRUE on success, but it is safer to encase
   *                     method call in a try/catch block and assume success
   *                     if no exception is thrown.
   */
  public function copy(string $oldfile, string $newfile) {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.decompress.php )
   *
   * For tar-based archives, this method decompresses the entire archive.
   *
   * For Zip-based archives, this method fails with an exception. The zlib
   * extension must be enabled to decompress an archive compressed with gzip
   * compression, and the bzip2 extension must be enabled in order to
   * decompress an archive compressed with bzip2 compression.
   *
   * In addition, this method automatically renames the file extension of the
   * archive, .tar by default. Alternatively, a file extension may be
   * specified with the second parameter.
   *
   * @extension  mixed   For decompressing, the default file extension is
   *                     .phar.tar. Use this parameter to specify another
   *                     file extension. Be aware that no non-executable
   *                     archives cannot contain .phar in their filename.
   *
   * @return     mixed   A PharData object is returned.
   */
  public function decompress(string $extension = ".phar.tar") {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.decompressfiles.php )
   *
   *
   * @return     mixed   Returns TRUE on success or FALSE on failure.
   */
  public function decompressFiles() {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.delmetadata.php )
   *
   *
   * @return     mixed   returns TRUE on success, but it is better to check
   *                     for thrown exception, and assume success if none is
   *                     thrown.
   */
  public function delMetadata() {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.delete.php )
   *
   * Delete a file within an archive. This is the functional equivalent of
   * calling unlink() on the stream wrapper equivalent, as shown in the
   * example below.
   *
   * @entry      mixed   Path within an archive to the file to delete.
   *
   * @return     mixed   returns TRUE on success, but it is better to check
   *                     for thrown exception, and assume success if none is
   *                     thrown.
   */
  public function delete(string $entry) {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.extractto.php )
   *
   * Extract all files within a tar/zip archive to disk. Extracted files and
   * directories preserve permissions as stored in the archive. The optional
   * parameters allow optional control over which files are extracted, and
   * whether existing files on disk can be overwritten. The second parameter
   * files can be either the name of a file or directory to extract, or an
   * array of names of files and directories to extract. By default, this
   * method will not overwrite existing files, the third parameter can be set
   * to true to enable overwriting of files. This method is similar to
   * ZipArchive::extractTo().
   *
   * @pathto     mixed   Path within an archive to the file to delete.
   * @files      mixed   The name of a file or directory to extract, or an
   *                     array of files/directories to extract
   * @overwrite  mixed   Set to TRUE to enable overwriting existing files
   *
   * @return     mixed   returns TRUE on success, but it is better to check
   *                     for thrown exception, and assume success if none is
   *                     thrown.
   */
  public function extractTo(
      string $pathto,
      mixed $files = null,
      bool $overwrite = false) {

    $fp = fopen($this->fname, 'rb');
    if (!$fp) {
      throw new Exception("Invalid argument, {$this->fname} cannot be found");
    }

    if (!$pathto) {
      throw new Exception(
        "Invalid argument, extraction path must be non-zero length"
      );
    }

    if (is_file($pathto)) {
      throw new Exception(
        "Unable to use path \"$pathto\" for extraction, it is a file, ".
        "must be a directory"
      );
    } else if (!is_dir($pathto)) {
      mkdir($pathto);
    }

    $this->archiveHandler->extractAllTo($pathto);
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.iswritable.php )
   *
   * This method returns TRUE if the tar/zip archive on disk is not
   * read-only. Unlike Phar::isWritable(), data-only tar/zip archives can be
   * modified even if phar.readonly is set to 1.
   * No parameters.
   *
   * @return     mixed   Returns TRUE if the tar/zip archive can be modified
   */
  public function isWritable() {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.setalias.php )
   *
   * Non-executable tar/zip archives cannot have an alias, so this method
   * simply throws an exception.
   *
   * @alias      mixed   A shorthand string that this archive can be referred
   *                     to in phar stream wrapper access. This parameter is
   *                     ignored.
   */
  public function setAlias(string $alias) {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.setdefaultstub.php )
   *
   * Non-executable tar/zip archives cannot have a stub, so this method
   * simply throws an exception.
   *
   * @index      mixed   Relative path within the phar archive to run if
   *                     accessed on the command-line
   * @webindex   mixed   Relative path within the phar archive to run if
   *                     accessed through a web browser
   *
   * @return     mixed   Returns TRUE on success or FALSE on failure.
   */
  public function setDefaultStub(string $index, string $webindex) {
    throw new Exception('Not implemented yet');
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/phardata.setstub.php )
   *
   * Non-executable tar/zip archives cannot have a stub, so this method
   * simply throws an exception.
   *
   * @stub       mixed   A string or an open stream handle to use as the
   *                     executable stub for this phar archive. This
   *                     parameter is ignored.
   * @len        mixed
   *
   * @return     mixed   Returns TRUE on success or FALSE on failure.
   */
  public function setStub(string $stub, int $len = -1) {
    throw new Exception('Not implemented yet');
  }
}
