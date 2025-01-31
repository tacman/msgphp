<?php

declare(strict_types=1);

namespace MsgPhp\Domain\Infrastructure\Elasticsearch;

use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use MsgPhp\Domain\Projection\ProjectionRepository as BaseProjectionRepository;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class ProjectionRepository implements BaseProjectionRepository
{
    private $client;
    private $prefix;
    private $bulkLimit;

    /**
     * @param array<string, string> $lookup
     */
    public function __construct(Client $client, string $prefix, int $bulkLimit = 1000)
    {
        $this->client = $client;
        $this->prefix = $prefix;
        $this->bulkLimit = $bulkLimit;
    }

    public function find(string $type, string $id): ?array
    {
        try {
            /** @var array $document */
            $document = $this->client->get([
                'index' => $this->prefix.$type,
                'id' => $id,
            ]);
        } catch (Missing404Exception $e) {
            return null;
        }

        return $document['_source'] ?? null;
    }

    public function save(string $type, array $document): void
    {
        $this->client->index([
            'index' => $this->prefix.$type,
            'id' => $document['id'] ?? null,
            'body' => $document,
        ]);
    }

    public function saveAll(string $type, iterable $documents): void
    {
        $params = $defaultParams = ['refresh' => true];
        $i = 0;

        foreach ($documents as $document) {
            ++$i;

            $params['body'][] = [
                'index' => [
                    '_index' => $this->prefix.$type,
                    '_id' => $document['id'] ?? null,
                ],
            ];

            $params['body'][] = $document;

            if (0 === $i % $this->bulkLimit) {
                $this->client->bulk($params);
                $params = $defaultParams;
            }
        }

        if (isset($params['body'])) {
            $this->client->bulk($params);
        }
    }

    public function delete(string $type, string $id): bool
    {
        try {
            $this->client->delete([
                'index' => $this->prefix.$type,
                'id' => $id,
            ]);

            return true;
        } catch (Missing404Exception $e) {
            return false;
        }
    }
}
