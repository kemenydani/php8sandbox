<?php

declare(strict_types=1);

namespace src\main\application\controller;

use src\main\framework\config\attribute\ConfigValue;
use src\main\framework\request\attribute\Dependency;
use src\main\framework\request\attribute\PathParam;
use src\main\framework\request\attribute\QueryParam;
use src\main\framework\request\attribute\RequestMapping;
use src\main\framework\request\RequestInfo;
use src\main\framework\request\RequestMethod;
use src\main\framework\request\ServerInfo;

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
