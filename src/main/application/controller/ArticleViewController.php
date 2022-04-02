<?php

declare(strict_types=1);

namespace application\controller;

use framework\config\attribute\ConfigValue;
use framework\request\attribute\Dependency;
use framework\request\attribute\PathParam;
use framework\request\attribute\QueryParam;
use framework\request\attribute\RequestMapping;
use framework\request\RequestInfo;
use framework\request\RequestMethod;
use framework\request\ServerInfo;

#[RequestMapping(RequestMethod::GET, ["/article/view/{year}/{title}", "/blog/view/{year}/{title}"])]
final class ArticleViewController implements Controller {
    private string $title;
    private int $year;
    private ?int $param1;
    private ?string $param2;

    private ServerInfo $serverInfo;
    private RequestInfo $requestInfo;

    #[ConfigValue("db", "some_value")]
    private string $configValue;

    #[ConfigValue("db", "some_value_two")]
    private int $configValueTwo;

    public function __construct(
        #[PathParam("title")] string $title,
        #[PathParam("year")] int $year,
        #[QueryParam("param1")] ?int $param1,
        #[QueryParam("param2")] ?string $param2,
        #[Dependency(ServerInfo::class)] ServerInfo $serverInfo,
        #[Dependency(RequestInfo::class)] RequestInfo $requestInfo
    ) {
        $this->title = $title;
        $this->year = $year;
        $this->param1 = $param1;
        $this->param2 = $param2;

        $this->serverInfo = $serverInfo;
        $this->requestInfo = $requestInfo;
    }

    public function __invoke(): void {
        echo "title: {$this->title}, year: {$this->year}, param1: {$this->param1}, param2: {$this->param2}";
        var_dump($this->serverInfo);
        var_dump($this->requestInfo);
        var_dump($this->configValue);
        var_dump($this->configValueTwo);
    }
}
