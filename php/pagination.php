<?php 


    function renderPagination(
                        int $currentPage,
                        int $totalPages,
                        array $extraParams =[]
    ): void {
        
        if ($totalPages <= 1){return;}

        $buildURL = function(int $page) use ($extraParams): string {
            $params = array_merge($extraParams, ['page' => $page]);
            return '?' . http_build_query($params);
        };
        ?>

        <div class="w-full flex justify-center items-center overflow-hidden">
            <nav class="flex items-center justify-center gap-1 sm:gap-2 py-8">
                <?php if ($currentPage > 1): ?>
                    <!-- Previous -->
                    <a href="<?= $buildURL($currentPage - 1) ?>"
                    class="pText px-2 sm:px-4 py-2 rounded-[var(--rounded-small)] border border-[var(--line-color)] hover:bg-[var(--decent-color)] transition-colors">
                        <span class="hidden sm:inline">&laquo; Predošlá</span>
                        <span class="sm:hidden">&laquo;</span>
                    </a>
                <?php endif; ?>

                <?php
                    $start = max(1, $currentPage - 2);
                    $end = min($totalPages, $currentPage + 2);
                
                    if ($start > 1): ?>
                        <!-- First page -->
                        <a href="<?= $buildURL(1) ?>"
                        class="pText px-2 sm:px-3 py-2 rounded-[var(--rounded-small)] hover:bg-[var(--decent-color)] transition-colors">
                            1
                        </a>

                        <?php if ($start > 2): ?>
                            <!-- Ellipsis -->
                            <span class="pText px-1">
                                …
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php for ($i = $start; $i <= $end; $i++): ?>
                    <!-- Pages -->
                    <a href="<?= $buildURL($i) ?>"
                    class="pText px-2 sm:px-3 py-2 rounded-[var(--rounded-small)] hover:bg-[var(--decent-color)] transition-colors 
                        <?= 
                            $i === $currentPage 
                            ? 'bg-[var(--accent-primary-color)] text-white'
                            : 'hover:bg-[var(--decent-color)]'
                        ?>
                    ">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($end < $totalPages): ?>
                    <?php if ($end < $totalPages - 1): ?>
                        <!-- Ellipsis -->
                        <span class="pText px-1">
                            …
                        </span>
                    <?php endif; ?>

                    <!-- Last page -->
                    <a href="<?= $buildURL($totalPages) ?>"
                    class="pText px-2 sm:px-3 py-2 rounded-[var(--rounded-small)] hover:bg-[var(--decent-color)] transition-colors">
                        <?= $totalPages ?>
                    </a>
                <?php endif; ?>

                <?php if ($currentPage < $totalPages) : ?>
                    <!-- Next -->
                    <a href="<?= $buildURL($currentPage + 1) ?>"
                    class="pText px-2 sm:px-4 py-2 rounded-[var(--rounded-small)] border border-[var(--line-color)] hover:bg-[var(--decent-color)] transition-colors">
                        <span class="hidden sm:inline">Ďalšia &raquo;</span>
                        <span class="sm:hidden">&raquo;</span>
                    </a>
                <?php endif; ?>

            </nav>
        </div>
    <?php
    }
?>