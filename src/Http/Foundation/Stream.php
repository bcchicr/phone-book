<?php

namespace Bcchicr\StudentList\Http\Foundation;

use RuntimeException;
use InvalidArgumentException;
use Throwable;

class Stream
{
    /**
     * @var ?resource
     */
    private mixed $stream;
    private bool $isSeekable;
    private bool $isReadable;
    private bool $isWritable;
    private ?int $size = null;

    private const READ_WRITE_HASH = [
        'read' => [
            'r' => true, 'w+' => true, 'r+' => true, 'x+' => true, 'c+' => true,
            'rb' => true, 'w+b' => true, 'r+b' => true, 'x+b' => true,
            'c+b' => true, 'rt' => true, 'w+t' => true, 'r+t' => true,
            'x+t' => true, 'c+t' => true, 'a+' => true,
        ],
        'write' => [
            'w' => true, 'w+' => true, 'rw' => true, 'r+' => true, 'x+' => true,
            'c+' => true, 'wb' => true, 'w+b' => true, 'r+b' => true,
            'x+b' => true, 'c+b' => true, 'w+t' => true, 'r+t' => true,
            'x+t' => true, 'c+t' => true, 'a' => true, 'a+' => true,
        ],
    ];

    public static function create($body = ''): Stream
    {
        if ($body instanceof Stream) {
            return $body;
        }
        if (is_string($body)) {
            $resource = fopen('php://temp', 'r+');
            fwrite($resource, $body);
            fseek($resource, 0);
            $body = $resource;
        }
        if (!self::isStream($body)) {
            throw new InvalidArgumentException("First argument to Stream::__construct() must be a string, stream resource or Stream");
        }
        return new self($body);
    }

    public function __construct(mixed $body)
    {
        if (!self::isStream($body)) {
            throw new InvalidArgumentException("First argument to Stream::__construct() must be a stream resource");
        }

        $this->stream = $body;
        $meta = stream_get_meta_data($this->stream);
        $this->isSeekable = $meta['seekable'] && fseek($this->stream, 0, SEEK_CUR) === 0;
        $this->isReadable = isset(self::READ_WRITE_HASH['read'][$meta['mode']]);
        $this->isWritable = isset(self::READ_WRITE_HASH['write'][$meta['mode']]);
    }
    public function __destruct()
    {
        $this->close();
    }
    public function __toString(): string
    {
        if ($this->isSeekable) {
            $this->rewind();
        }
        return $this->getContents();
    }
    public function close(): void
    {
        if (!isset($this->stream)) {
            return;
        }
        fclose($this->stream);
        $this->detach();
    }
    public function detach()
    {
        if (!isset($this->stream)) {
            return null;
        }
        $result = $this->stream;
        unset($this->stream);
        $this->size = null;
        $this->isReadable = $this->isWritable = $this->isSeekable = false;
        return $result;
    }
    public function getSize(): ?int
    {
        if (!is_null($this->size)) {
            return $this->size;
        }
        if (!isset($this->stream)) {
            return null;
        }
        $stats = fstat($this->stream);
        if (isset($stats['size'])) {
            $this->size = $stats['size'];
            return $this->size;
        }
        return null;
    }
    public function tell(): int
    {
        if (!isset($this->stream)) {
            throw new RuntimeException('Stream is detached');
        }
        $result = @ftell($this->stream);
        if ($result === false) {
            throw new RuntimeException('Unable to determine stream position: ' . error_get_last()['message'] ?? '');
        }
        return $result;
    }
    public function eof(): bool
    {
        return !isset($this->stream) || feof($this->stream);
    }
    public function isSeekable(): bool
    {
        return $this->isSeekable;
    }
    public function seek($offset, $whence = SEEK_SET): void
    {
        if (!isset($this->stream)) {
            throw new RuntimeException('Stream is detached');
        }
        if (!$this->isSeekable) {
            throw new RuntimeException('Stream is not seekable');
        }
        if (fseek($this->stream, $offset, $whence) === -1) {
            throw new RuntimeException('Unable to seek to stream position "' . $offset . '" with whence ' . var_export($whence, true));
        }
    }
    public function rewind(): void
    {
        $this->seek(0);
    }
    public function isWritable(): bool
    {
        return $this->isWritable;
    }
    public function write(string $data): int
    {
        if (!isset($this->stream)) {
            throw new RuntimeException('Stream is detached');
        }
        if (!$this->isWritable) {
            throw new RuntimeException('Stream is not writable');
        }
        $this->size = null;

        $result = @fwrite($this->stream, $data);
        if ($result === false) {
            throw new RuntimeException('Unable to write to stream: ' . error_get_last()['message'] ?? '');
        }
        return $result;
    }
    public function isReadable(): bool
    {
        return $this->isReadable;
    }
    public function read(int $length): string
    {
        if (!isset($this->stream)) {
            throw new RuntimeException('Stream is detached');
        }
        if (!$this->isReadable) {
            throw new RuntimeException('Stream is not readable');
        }
        $this->size = null;

        $result = @fread($this->stream, $length);
        if ($result === false) {
            throw new RuntimeException('Unable to read from stream: ' . error_get_last()['message'] ?? '');
        }
        return $result;
    }
    public function getContents(): string
    {
        if (!isset($this->stream)) {
            throw new RuntimeException('Stream is detached');
        }
        try {
            return stream_get_contents($this->stream);
        } catch (Throwable $e) {
            throw new RuntimeException('Unable to read stream contents: ' . $e->getMessage());
        }
    }
    public function getMetadata(?string $key = null)
    {
        if (!isset($this->stream)) {
            return $key ? null : [];
        }
        $meta = stream_get_meta_data($this->stream);
        if (is_null($key)) {
            return $meta;
        }
        return $meta[$key] ?? null;
    }
    public static function isStream(mixed $value)
    {
        return
            is_resource($value) &&
            get_resource_type($value) === 'stream';
    }
}
